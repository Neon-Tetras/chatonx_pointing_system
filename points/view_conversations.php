<?php

/*
 * 
 * This script when called gets all the users and their completed conversations for the previous day
 * Then award points to them based on the number of completed conversations
 * This script should be called once a day and call using cron jobs
 * 
 */


require_once '../bootstrap.php';

$user_rep = $entityManager->getRepository(User::class);
 $allUsers = $user_rep->findAll();
// 
 foreach ($allUsers as $users){
    // echo $users->getId();
     doPoint($entityManager,$users->getId());
 }
// doPoint($entityManager,6);
function doPoint($entityManager,$userId) {
    try{
   // echo $userId;
    $d = new DateTime();
    $d2 = $d->format("Y-m-d");
    $from_unix_time = strtotime($d2);
    $date = date('Y-m-d', strtotime("yesterday", $from_unix_time));
    $from = $date;//date("Y-m-d", strtotime(filter_input(INPUT_GET, "from")));
    $to = $date;

    $user = $entityManager->find(User::class, $userId);


    if (!$user) {
        echo sprintf("User with id %d does not exist", $userId);
        exit(1);
    }

    $c = $entityManager->getRepository(Conversations::class)->getConversationsByDates($userId, $from, $to);


    if ($c) {
        $num_received = 0;
        $num_sent = 0;
        $participants = array();
        foreach ($c as $co) {

            echo "conversation id = " . $co->getId() . "\n";

            foreach ($co->getMessages() as $m) {
                $sent_received = $m->getUser()->getId() == $userId ? "sent" : "received";
                echo sprintf("Message user: %d\t"
                        . "Conversation sender %d\n"
                        . "", $m->getUser()->getId(), $co->getSender()->getId());

                if (!in_array($m->getUser(), $participants)) {
                    array_push($participants, $m->getUser());
                }
                if ($m->getUser()->getId() == $userId && $co->getSender() == $m->getUser()) {
                    $num_sent++;

                    $users = array("sender" => $co->getSender(), "recipient" => $co->getRecipient());
                } else {

                    $num_received++;
//                       
                    $users = array("sender" => $co->getRecipient(), "recipient" => $co->getSender());
                }
                echo sprintf("$sent_received: %d-%s\tfrom: %d-%s\tto: %d-%s \tDate: %s\n\n", $m->getId(), $m->getMessage(), $users["sender"]->getId(), $users["sender"]->getUsername(), $users["recipient"]->getId(), $users["recipient"]->getUsername(), $m->getDate()->format("Y-m-d"));
            }
        }
        $average = 0;
        if ($num_sent != 0 && $num_received != 0) {

            $divisor = count($participants);
            $average = ($num_sent + $num_received) / $divisor;
        }
        echo sprintf("\nNumber of participants %d\n", count($participants));
        echo sprintf("Total messages sent = %d\nTotal messages Received = %d\nTotal completed conversations =  %d\n", $num_sent, $num_received, $average);
        $rep = $entityManager->getRepository(User::class);
        $allUsers = $rep->findAll();
        $totalUsersInSystem = count($allUsers);
        $file = fopen("total_points.txt","r") or die("Unable to open file"); 
       
        $totalPointsInSystem = fgets($file);

        $pointsEarned = ($totalPointsInSystem / $totalUsersInSystem) * ($average / 100);


        echo sprintf("Total users: %d\n", count($allUsers));

        echo sprintf("Points earned: %f ", $pointsEarned);

        $point = $pointsEarned;

        $points = new Points();
        $points->createPoint($entityManager, $userId, $point);
    } else {
        echo "$userId - No conversation<p>";
    }
    }catch(Exception $e){
    echo $e->getMessage();
}
}

