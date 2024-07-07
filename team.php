<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Organizational Structure</title>
    <link rel="stylesheet" href="css/team.css">
</head>
<body>
    <div class="container">
        <img src="img/kr.jpg" alt="UCF Logo" class="ucf-logo">
        <h1>UCF Organizational Structure</h1>
        <div class="org-chart">
            <?php
            $teamStructure = [
                [
                    'name' => 'Mona',
                    'position' => 'Director',
                    'image' => 'img/person.jpg',
                ],
                [
                    'name' => 'Ur Mom',
                    'position' => 'not enough',
                    'image' => 'img/person.jpg',
                ],
                [
                    'name' => 'car on fire',
                    'position' => 'EV Team',
                    'image' => 'img/person.jpg',
                ],
                [
                    'name' => 'taco bell',
                    'position' => 'crack whore',
                    'image' => 'img/person.jpg',
                ],
            ];

            foreach ($teamStructure as $index => $member) {
                if ($index == 0) {
                    echo "<div class='level'>";
                    echo "<div class='team-member'>";
                    echo "<img src='{$member['image']}' alt='{$member['name']}'>";
                    echo "<h2>{$member['name']}</h2>";
                    echo "<p>{$member['position']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='org-line-horizontal'></div>";
                } elseif ($index == 1) {
                    echo "<div class='level'>";
                    echo "<div class='team-member'>";
                    echo "<img src='{$member['image']}' alt='{$member['name']}'>";
                    echo "<h2>{$member['name']}</h2>";
                    echo "<p>{$member['position']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='org-line-horizontal'></div>";
                    echo "<div class='org-line-container'>";
                    echo "<div class='org-line-branch'></div>";
                    echo "<div class='org-line-branch'></div>";
                    echo "</div>";
                } else {
                    if ($index == 2) echo "<div class='level'>";
                    echo "<div class='team-member'>";
                    echo "<img src='{$member['image']}' alt='{$member['name']}'>";
                    echo "<h2>{$member['name']}</h2>";
                    echo "<p>{$member['position']}</p>";
                    echo "</div>";
                    if ($index == count($teamStructure) - 1) echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</html>