<?php

namespace App\Controller;

use App\Entity\ExpenseLine;
use App\Entity\ExpenseReport;
use App\Form\ExpenseReportType;
use App\Service\ExpenseCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class ExpenseReportController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->redirectToRoute('expense_report_new');
    }

    #[Route('/expense-report/new', name: 'expense_report_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        ExpenseCalculator $calculator,
        SluggerInterface $slugger
    ): Response {
        $report = new ExpenseReport();
        $report->setRequestDate(new \DateTime());
        $report->setBudget('Administratif');
        $report->setMileageRate(0.606);
        $report->setDonationAmount(0);

        if (count($report->getLines()) === 0) {
            $line = new ExpenseLine();
            $line->setExpenseDate(new \DateTime());
            $report->addLine($line);
        }

        $form = $this->createForm(ExpenseReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $report->setCreatedAt(new \DateTime());

            $calculator->compute($report);

            /** @var UploadedFile[] $uploadedFiles */
            $uploadedFiles = $form->get('supportingDocuments')->getData();

            foreach ($uploadedFiles as $uploadedFile) {
                $safeFilename = $slugger->slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                $uploadedFile->move(
                    $this->getParameter('kernel.project_dir') . '/public/uploads/justificatifs',
                    $newFilename
                );
            }

            $entityManager->persist($report);
            $entityManager->flush();

            return $this->redirectToRoute('expense_report_success');
        }

        return $this->render('expense_report/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/expense-report/success', name: 'expense_report_success')]
    public function success(): Response
    {
        return $this->render('expense_report/success.html.twig');
    }
}