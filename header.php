<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Love Pizza</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <?php 
        foreach($optStyle ?? [] as $n){
            echo "<link rel='stylesheet' href='css/{$n}.css'>" ;
        }
    ?>
</head>
<body>
    <div class="wrapper">
    <header>
        <h1><a href="index.php">I Love Pizza</a></h1>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f57e69" fill-opacity="1" d="M0,192L14.1,208C28.2,224,56,256,85,245.3C112.9,235,141,181,169,186.7C197.6,192,226,256,254,256C282.4,256,311,192,339,144C367.1,96,395,64,424,69.3C451.8,75,480,117,508,149.3C536.5,181,565,203,593,208C621.2,213,649,203,678,202.7C705.9,203,734,213,762,213.3C790.6,213,819,203,847,186.7C875.3,171,904,149,932,160C960,171,988,213,1016,224C1044.7,235,1073,213,1101,197.3C1129.4,181,1158,171,1186,144C1214.1,117,1242,75,1271,64C1298.8,53,1327,75,1355,101.3C1383.5,128,1412,160,1426,176L1440,192L1440,320L1425.9,320C1411.8,320,1384,320,1355,320C1327.1,320,1299,320,1271,320C1242.4,320,1214,320,1186,320C1157.6,320,1129,320,1101,320C1072.9,320,1045,320,1016,320C988.2,320,960,320,932,320C903.5,320,875,320,847,320C818.8,320,791,320,762,320C734.1,320,706,320,678,320C649.4,320,621,320,593,320C564.7,320,536,320,508,320C480,320,452,320,424,320C395.3,320,367,320,339,320C310.6,320,282,320,254,320C225.9,320,198,320,169,320C141.2,320,113,320,85,320C56.5,320,28,320,14,320L0,320Z"></path></svg>
    </header>