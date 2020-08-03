<?php

class AdminEventManager
{
    public static function CreateView()
    {
        if (!empty($_POST)) {

            // Gathering info from the form and formatting them to fit the Database requirements

            $title = $_POST['titleEvent'];
            $difficulty = $_POST['eventDifficulty'];
            $level = $_POST['eventLevel'];

            // exploding date and time to prevent non well formed numeric errors
            $date = explode('-', $_POST['eventDate']);
            $year = $date[0];
            $month = $date[1];
            $day = $date[2];

            $startTime = explode(':', $_POST['eventStart']);
            $endTime = explode(':', $_POST['eventEnd']);
            $startHour = $startTime[0];
            $startMinutes = $startTime[1];
            $endHour = $endTime[0];
            $endMinutes = $endTime[1];

            // forming the new date 

            $dateStart = "$year-$month-$day $startHour:$startMinutes";
            $dateEnd = "$year-$month-$day $endHour:$endMinutes";

            $startAt = date('Y-m-d H:i:s', strtotime($dateStart));
            $endAt = date('Y-m-d H:i:s', strtotime($dateEnd));

            $model = new EventModel;
            $model->saveEvent($title, $difficulty, $level, $startAt, $endAt);
            header('Location: ./admin-events');
            exit();
        }

        $blank = "";
        $variables = compact('blank');

        Utils::render('AdminEventManager', $variables);
    }
}
