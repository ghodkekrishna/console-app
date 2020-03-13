<?php
namespace Console\App\Model;

class SalaryModel
{
    /**
     * This function used to create CSV file for salary dates of whole year.
     *
     * @author Krishna Ghodke
     *
     * @param string $year
     *
     * @return boolean
     */
    public function downloadCSVFile($year)
    {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        //create CSV file with headers
        $headers = ['month-name', 'salary-payment-date', 'bonus-payment-date'];
        $file = fopen("public/files/salary-dates-".$year."-".time().".csv", "w");
        fputcsv($file, $headers);

        //update CSV file with month-wise
        foreach ($months as $month){
           fputcsv($file, $this->getSalaryAndBonusDateByMonth($month, $year));
        }

        fclose($file);

        return true;
    }

    /**
     * Return the last day of the Month
     *
     * @author Krishna Ghodke
     *
     * @param string $month
     * @param string $year
     *
     * @return array
     */
    function getSalaryAndBonusDateByMonth($month, $year)
    {
        $date = date('Y-m-d',strtotime("last day of $month $year"));
        if(in_array(date('l', strtotime($date)), ['Saturday', 'Sunday'])){
            if(date('l', strtotime($date)) == 'Saturday'){
                $date = date('Y-m-d',strtotime('-1 day', strtotime($date)));
            }else{
                $date = date('Y-m-d',strtotime('-2 day', strtotime($date)));
            }
        }

        return [$month, $date, $this->getBonusDatesByMonth()[$month]];
    }

    /**
     * Return the bonus dates of the Month
     *
     * @author Krishna Ghodke
     *
     * @return array
     */
    function getBonusDatesByMonth()
    {
        $months=[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $bonusData = [];
        foreach($months as $key => $month){
            $date = date("Y-m-d", mktime(0,0,0,$month,15));
            if(in_array(date('l', strtotime($date)), ['Saturday', 'Sunday'])){
                $date = date('Y-m-d', strtotime('next wednesday', strtotime($date)));
            }

            $bonusData[date("F",strtotime($date))] = $date;
        }
        return $bonusData;
    }
}