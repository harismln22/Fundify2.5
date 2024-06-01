<?php
include_once("model/Template.php");
class GrafikView
{
    public function render($incomeData, $expenseData)
    {
        $template = new Template("layout/grafik.html");
        $template->replace("INCOME_DATA", json_encode($incomeData));
        $template->replace("EXPENSE_DATA", json_encode($expenseData));
        $template->write();
    }
}
