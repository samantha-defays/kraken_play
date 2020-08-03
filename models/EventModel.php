<?php

class EventModel
{

    // Getting the total number of events
    public function countTotalEvents()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT COUNT(*) as `total` FROM `events`";
        $query = $pdo->query($sql);
        $totalNumber = $query->fetch();

        return $totalNumber;
    }

    // Creating a new event
    public function saveEvent($title, $difficulty, $level, $startAt, $endAt)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO events VALUES (NULL, :title, :difficulty, :level, :startAt, :endAt, 0)";

        $query = $pdo->prepare($sql);
        $query->execute([
            'title' => $title,
            'difficulty' => $difficulty,
            'level' => $level,
            'startAt' => $startAt,
            'endAt' => $endAt
        ]);
    }

    // Saving modifications of an event

    // Fetching the list of all events
    public function getEventList()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT * FROM events";

        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    // Fetching the three next events
    public function getNextEvents()
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT id, title, difficulty, `level`, participants, DATE_FORMAT(startAt, \"%w\") AS startWeekday, EXTRACT(DAY from startAt) AS startDay, EXTRACT(MONTH from startAt) AS startMonth, EXTRACT(HOUR from startAt) AS startHour, EXTRACT(MINUTE from startAt) AS startMinute, EXTRACT(HOUR from endAt) AS endHour, EXTRACT(MINUTE from endAt) AS endMinute
        FROM events
        WHERE startAt >= NOW() LIMIT 3";
        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    // fetching infos from one event to pre-fill the edition form
    public function getEventInfoById($eventID)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT id, title, difficulty, level, CAST(startAt as date) AS day, CAST(startAt as time) AS startHour, CAST(endAt as time) AS endHour FROM events WHERE id = :eventID";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':eventID' => $eventID
        ]);
        return $query->fetch();
    }

    // Deleting an event
    public function deleteEvent($id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "DELETE FROM event_users WHERE eventID = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $sql = "DELETE FROM events WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }

    // updating an event
    public function updateEvent($title, $difficulty, $level, $startAt, $endAt, $id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "UPDATE events 
        SET title = :title,
            difficulty = :difficulty,
            `level` = :level,
            startAt = :startAt,
            endAt = :endAt
        WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'title' => $title,
            'difficulty' => $difficulty,
            'level' => $level,
            'startAt' => $startAt,
            'endAt' => $endAt,
            'id' => $id
        ]);
    }

    // getting number of participants for one event
    private function getTotalParticipants($id)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "SELECT participants FROM events WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    // Adding the user ID into the event_users table
    private function addParticipant($userID, $eventID)
    {
        $pdo = DatabaseModel::getConnection();

        $sql = "INSERT INTO event_users VALUES (:eventID, :userID)";
        $query = $pdo->prepare($sql);
        $query->execute([
            'eventID' => $eventID,
            'userID' => $userID
        ]);
    }

    // Signing up for an event
    public function registeringUserForEvent($userID, $eventID)
    {
        $userParticipates = false;
        if (empty($this->checkUserParticipation($userID, $eventID))) {

            $totalParticipants = $this->getTotalParticipants($eventID);
            intval($totalParticipants['participants']);

            $pdo = DatabaseModel::getConnection();
            $sql = "UPDATE events SET participants = :participants WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->execute([
                'participants' => ++$totalParticipants['participants'],
                'id' => $eventID
            ]);

            $this->addParticipant($userID, $eventID);
        } else {
            throw new Exception("Vous êtes déjà inscrit à cet événement !");
        }
    }

    // checking to see if user already participates to this event
    public function checkUserParticipation($userID, $eventID)
    {
        $pdo = DatabaseModel::getConnection();
        $sql = "SELECT userID FROM event_users WHERE userID = :userID AND eventID = :eventID";
        $query = $pdo->prepare($sql);
        $query->execute([
            'userID' => $userID,
            'eventID' => $eventID
        ]);
        return $query->fetch();
    }
}
