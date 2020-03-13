<?php
namespace Console\App\Model;

class SalaryModel
{
    /**
     * This function used to create CSV file for salary dates of whole year.
     *
     * @author Krishna Ghodke
     *
     * @return boolean
     */
    public function downloadCSVFile()
    {
        // Current year and month list
        $year = date("Y");
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
        $lastDate = date('d-m-Y',strtotime("last day of $month $year"));
        $date = strtotime($lastDate);
        $day = date('l', $date);

        $bonusDate = $this->getBonusDatesByMonth();
        $weekend = ['Saturday', 'Sunday'];
        if(in_array($day, $weekend)){
            if($day == 'Saturday'){
                $dayAfterTomorrowDate = date ('Y-m-d',strtotime('-1 day', $date));
                $dayAfterTomorrowDate = strtotime($dayAfterTomorrowDate);
                $lastDate = date('d-m-Y', $dayAfterTomorrowDate);
            }else{
                $tomorrowDate = date ('Y-m-d',strtotime('-2 day', $date));
                $tomorrowDate = strtotime($tomorrowDate);
                $lastDate = date('d-m-Y', $tomorrowDate);
            }
        }

        return [$month, $lastDate, $bonusDate[$month]];
    }

    /**
     * Return the 15th day of the Month
     *
     * @author Krishna Ghodke
     *
     * @return array
     */
    function getBonusDatesByMonth()
    {
        $beginDate = new \DateTime('15 January');

        // clone start date
        $endDate = clone $beginDate;

        // Add 1 year to start date
        $endDate->modify('+1 year');

        // Increase with an interval of one month
        $dateInterval = new \DateInterval('P1M');

        $dateRange = new \DatePeriod($beginDate, $dateInterval, $endDate);

        $bonusData = [];
        foreach ($dateRange as $day) {
            $lastDate = date('d-m-Y',strtotime($day->format('Y-m-d')));
            $date = strtotime($lastDate);
            $day = date('l', $date);
            $month=date("F",$date);

            $weekend = ['Saturday', 'Sunday'];
            if(in_array($day, $weekend)){
                $wednesdayNextWeek = date('Y-m-d', strtotime('next wednesday', $date));
                $wednesdayNextWeek = strtotime($wednesdayNextWeek);
                $lastDate = date('d-m-Y', $wednesdayNextWeek);
            }

            $bonusData[$month] = $lastDate;
        }

        return $bonusData;
    }
}