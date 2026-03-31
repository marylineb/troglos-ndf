<?php

namespace App\Service;

use App\Entity\ExpenseReport;

class ExpenseCalculator
{
    public function compute(ExpenseReport $report): void
    {
        $totalKm = 0;
        $totalTransport = 0;
        $totalOther = 0;

        foreach ($report->getLines() as $line) {
            $totalKm += $line->getKilometers() ?? 0;
            $totalTransport += $line->getTransportAmount() ?? 0;
            $totalOther += $line->getOtherAmount() ?? 0;
        }

        $kmAmount = $totalKm * ($report->getMileageRate() ?? 0);
        $total = $kmAmount + $totalTransport + $totalOther;

        $donation = $report->getDonationAmount() ?? 0;
        $taxDeduction = $donation * 0.66;
        $realCost = $donation - $taxDeduction;

        $report->setTotalKm($totalKm);
        $report->setTotalKmAmount($kmAmount);
        $report->setTotalTransportAmount($totalTransport);
        $report->setTotalOtherAmount($totalOther);
        $report->setTotalAmount($total);
        $report->setTaxDeductionAmount($taxDeduction);
        $report->setRealCostAfterDeduction($realCost);
        $report->setReimbursedAmount($total - $donation);
    }
}