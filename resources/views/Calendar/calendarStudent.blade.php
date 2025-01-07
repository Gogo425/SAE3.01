@extends('BaseCalendar')

@section('title', 'Student Calendar')

@section('content')

    <?php
    class Month{

        public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        private $month;
        private $year;

        /**
         * Month Constructor
         * @param int $month, the month between 1 and 12
         * @param int $year, the year of start the calendar
         * @throws Exception for $month
         */
        public function __construct(?int $month = null, ?int $year = null)
        {
            if($month === null){
                $month = intval(date('m'));
            }
            if($year === null){
                $year = intval(date('Y'));
            }

            $month = $month % 12;

            $this->month = $month;
            $this->year = $year;
        }

        /**
         * Return the first day in a month
         * @return DateTime
         */
        public function getStartingDay(): DateTime{
            return new DateTime("{$this->year}-{$this->month}-01");
        }

        /**
         * return the month with string (ex : march 2018)
         * @return string
         */
        public function toString() : string 
        {
            return $this->months[$this->month - 1].' '.$this->year;
        }

        /**
         * this function count the number of weeks in month
         *
         * @return integer
         */
        public function getWeeks(): int {
            $start = $this->getStartingDay();
            $end = (clone $start)->modify('+1 month -1 day');
            $weeks = intval($end->format('W')) - intval($start->format('W')) +1;
            if($weeks < 0){
                $weeks = intval($end->format('W'));
            }
            return $weeks;
        }
    }
    ?>

    <?php 
    $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $day = $month->getStartingDay()->modify('last monday');
    ?>
    <h1><?= $month->toString(); ?></h1>

    <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
        <?php for($i = 0 ; $i < $month->getWeeks(); $i++):?>
            <tr>
                <?php foreach($month->days as $day): ?>
                <td>
                    <div class="calendar__weekday"><?= $day; ?></div>
                    <div class="calendar__day"> MINUTE 36</div>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>

@endsection
