
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Organizational Structure</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/team.css">
</head>
<?php include 'header.php';?>
<body>
    <div class="container">
        <h1>UCF Organizational Structure</h1>
        <div class="org-chart">
            <?php
            $teamStructure = [
                [
                    'name' => 'Pete Alfieris',
                    'position' => 'Faculty Advisor',
                    'section' => 'UCF Faculty'
                ],
                [
                    'name' => 'TBD',
                    'position' => 'Accountant',
                    'section' => 'UCF Faculty'
                ],
                [
                    'name' => 'Hugo Bussy',
                    'position' => 'Administrative Director & DAQ',
                    'section' => 'Officers'
                ],
                [
                    'name' => 'Tony Reyes',
                    'position' => 'Assistant Administrative Director',
                    'section' => 'Officers'
                ],
                [
                    'name' => 'Gonzalo Montoya',
                    'position' => 'Technical Director & Aerodynamics',
                    'section' => 'Officers'
                ],
                [
                    'name' => 'Suzannah Newhouse',
                    'position' => 'Financial Director',
                    'section' => 'Officers'
                ],
                [
                    'name' => 'Dezso Kovi',
                    'position' => 'Assistant Director & Website Developer',
                    'section' => 'Officers'
                ],
                [
                    'name' => 'Tyler Bell',
                    'position' => 'Composites',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Sophia McNeill',
                    'position' => 'Chassis',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Austin Back',
                    'position' => 'Brakes',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'LeAidan Smith',
                    'position' => 'Ergonomics',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Andrew Mierau',
                    'position' => 'Electrical',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Jose Ojeda',
                    'position' => 'Electronics',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Riley Chunko',
                    'position' => 'Powertrain',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Nipun Warusawithana',
                    'position' => 'Suspension',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Justin Wills',
                    'position' => 'Business',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Sean Lynch',
                    'position' => 'Outreach',
                    'section' => 'Lead'
                ],
                [
                    'name' => 'Miguel Torres',
                    'position' => 'Manufacturing',
                    'section' => 'Lead'
                ]
            ];

            $sections = array_unique(array_column($teamStructure, 'section'));
            foreach ($sections as $section) {
                echo "<h2>$section</h2>";
                echo "<div class='level'>";
                foreach ($teamStructure as $member) {
                    if ($member['section'] == $section) {
                        echo "<div class='team-member'>";
                        echo "<h2>{$member['name']}</h2>";
                        echo "<p>{$member['position']}</p>";
                        echo "</div>";
                    }
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'footer.php';?>
</html>