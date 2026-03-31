<?php

namespace App\Entity;

use App\Repository\ExpenseReportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseReportRepository::class)]
class ExpenseReport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $requesterName = null;

    #[ORM\Column]
    private ?\DateTime $requestDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $expenseReason = null;

    #[ORM\Column(length: 255)]
    private ?string $budget = null;

    #[ORM\Column]
    private ?int $totalKm = null;

    #[ORM\Column]
    private ?float $mileageRate = null;

    #[ORM\Column]
    private ?float $totalKmAmount = null;

    #[ORM\Column]
    private ?float $totalTransportAmount = null;

    #[ORM\Column]
    private ?float $totalOtherAmount = null;

    #[ORM\Column]
    private ?float $totalAmount = null;

    #[ORM\Column(nullable: true)]
    private ?float $donationAmount = null;

    #[ORM\Column(nullable: true)]
    private ?float $taxDeductionAmount = null;

    #[ORM\Column(nullable: true)]
    private ?float $realCostAfterDeduction = null;

    #[ORM\Column]
    private ?float $reimbursedAmount = null;

    #[ORM\Column(length: 255)]
    private ?string $iban = null;

    #[ORM\Column(length: 255)]
    private ?string $bic = null;

    #[ORM\Column(length: 255)]
    private ?string $signatureName = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    /**
     * @var Collection<int, ExpenseLine>
     */
    #[ORM\OneToMany(targetEntity: ExpenseLine::class, mappedBy: 'expenseReport')]
    private Collection $lines;

    /**
     * @var Collection<int, Attachment>
     */
    #[ORM\OneToMany(targetEntity: Attachment::class, mappedBy: 'expenseReport')]
    private Collection $attachments;

    public function __construct()
    {
        $this->lines = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequesterName(): ?string
    {
        return $this->requesterName;
    }

    public function setRequesterName(string $requesterName): static
    {
        $this->requesterName = $requesterName;

        return $this;
    }

    public function getRequestDate(): ?\DateTime
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTime $requestDate): static
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function getExpenseReason(): ?string
    {
        return $this->expenseReason;
    }

    public function setExpenseReason(string $expenseReason): static
    {
        $this->expenseReason = $expenseReason;

        return $this;
    }

    public function getBudget(): ?string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getTotalKm(): ?int
    {
        return $this->totalKm;
    }

    public function setTotalKm(int $totalKm): static
    {
        $this->totalKm = $totalKm;

        return $this;
    }

    public function getMileageRate(): ?float
    {
        return $this->mileageRate;
    }

    public function setMileageRate(float $mileageRate): static
    {
        $this->mileageRate = $mileageRate;

        return $this;
    }

    public function getTotalKmAmount(): ?float
    {
        return $this->totalKmAmount;
    }

    public function setTotalKmAmount(float $totalKmAmount): static
    {
        $this->totalKmAmount = $totalKmAmount;

        return $this;
    }

    public function getTotalTransportAmount(): ?float
    {
        return $this->totalTransportAmount;
    }

    public function setTotalTransportAmount(float $totalTransportAmount): static
    {
        $this->totalTransportAmount = $totalTransportAmount;

        return $this;
    }

    public function getTotalOtherAmount(): ?float
    {
        return $this->totalOtherAmount;
    }

    public function setTotalOtherAmount(float $totalOtherAmount): static
    {
        $this->totalOtherAmount = $totalOtherAmount;

        return $this;
    }

    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): static
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getDonationAmount(): ?float
    {
        return $this->donationAmount;
    }

    public function setDonationAmount(?float $donationAmount): static
    {
        $this->donationAmount = $donationAmount;

        return $this;
    }

    public function getTaxDeductionAmount(): ?float
    {
        return $this->taxDeductionAmount;
    }

    public function setTaxDeductionAmount(?float $taxDeductionAmount): static
    {
        $this->taxDeductionAmount = $taxDeductionAmount;

        return $this;
    }

    public function getRealCostAfterDeduction(): ?float
    {
        return $this->realCostAfterDeduction;
    }

    public function setRealCostAfterDeduction(?float $realCostAfterDeduction): static
    {
        $this->realCostAfterDeduction = $realCostAfterDeduction;

        return $this;
    }

    public function getReimbursedAmount(): ?float
    {
        return $this->reimbursedAmount;
    }

    public function setReimbursedAmount(float $reimbursedAmount): static
    {
        $this->reimbursedAmount = $reimbursedAmount;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): static
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): static
    {
        $this->bic = $bic;

        return $this;
    }

    public function getSignatureName(): ?string
    {
        return $this->signatureName;
    }

    public function setSignatureName(string $signatureName): static
    {
        $this->signatureName = $signatureName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, ExpenseLine>
     */
    public function getLines(): Collection
    {
        return $this->lines;
    }

    public function addLine(ExpenseLine $line): static
    {
        if (!$this->lines->contains($line)) {
            $this->lines->add($line);
            $line->setExpenseReport($this);
        }

        return $this;
    }

    public function removeLine(ExpenseLine $line): static
    {
        if ($this->lines->removeElement($line)) {
            // set the owning side to null (unless already changed)
            if ($line->getExpenseReport() === $this) {
                $line->setExpenseReport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Attachment>
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(Attachment $attachment): static
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments->add($attachment);
            $attachment->setExpenseReport($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): static
    {
        if ($this->attachments->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getExpenseReport() === $this) {
                $attachment->setExpenseReport(null);
            }
        }

        return $this;
    }
}
