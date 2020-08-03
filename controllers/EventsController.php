<?php


class Events
{
    public function registerToEvent($eventID)
    {
        $userID = $_SESSION['user']['id'];

        $model = new EventModel;
        $model->registeringUserForEvent($userID, $eventID);

        header('Location: ./events');
        exit();
    }

    public static function CreateView()
    {
        $model = new EventModel;
        $events = $model->getNextEvents();

        $displayPictures = [
            './Views/img/tabletop_game.jpg',
            './Views/img/tabletop_game_2.jpg',
            './Views/img/tabletop_game_3.jpg'
        ];
        $i = 0;

        $weekdays = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

        $months = [
            '', "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ];

        $variables = compact('events', 'displayPictures', 'i', 'months', 'weekdays');

        Utils::render('Events', $variables);
    }
}
