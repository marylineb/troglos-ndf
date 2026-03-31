<?php

namespace App\Entity;

use App\Repository\ExpenseLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseLineRepository::class)]
class ExpenseLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ExpenseReport $expenseReport = null;

    #[ORM\Column]
    private ?\DateTime $expenseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $expenseLabel = null;

    #[ORM\Column(nullable: true)]
    private ?int $kilometers = null;

    #[ORM\Column(nullable: true)]
    private ?float $transportAmount = null;

    #[ORM\Column(nullable: true)]
    private ?float $otherAmount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpenseReport(): ?ExpenseReport
    {
        return $this->expenseReport;
    }

    public function setExpenseReport(?ExpenseReport $expenseReport): static
    {
        $this->expenseReport = $expenseReport;

        return $this;
    }

    public function getExpenseDate(): ?\DateTime
    {
        return $this->expenseDate;
    }

    public function setExpenseDate(\DateTime $expenseDate): static
    {
        $this->expenseDate = $expenseDate;

        return $this;
    }

    public function getExpenseLabel(): ?string
    {
        return $this->expenseLabel;
    }

    public function setExpenseLabel(string $expenseLabel): static
    {
        $this->expenseLabel = $expenseLabel;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(?int $kilometers): static
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getTransportAmount(): ?float
    {
        return $this->transportAmount;
    }

    public function setTransportAmount(?float $transportAmount): static
    {
        $this->transportAmount = $transportAmount;

        return $this;
    }

    public function getOtherAmount(): ?float
    {
        return $this->otherAmount;
    }

    public function setOtherAmount(?float $otherAmount): static
    {
        $this->otherAmount = $otherAmount;

        return $this;
    }
}
