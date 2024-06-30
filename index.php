<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>College Event Management System</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
    <?php require 'utils/header.php'; ?>
    
    <div class="content">
        <div class="container">
            <div class="col-md-12">
                <h1 style="color: #0b0b45; font-size: 35px; font-weight: bold;">Join the excitement by registering for your favourite events today!</h1>
            </div>
            
            <div class="container">
                <div class="col-md-12">
                    <hr style="border-top: 2px solid #00008B;">
                </div>
            </div>
            
            <!-- Technical Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <?php
                            $tech_image = "images/tech.jpg"; // Default image
                            if (file_exists($tech_image)) {
                                echo '<img src="' . $tech_image . '" class="img-responsive">';
                            } else {
                                echo '<img src="default_image.jpg" class="img-responsive">'; // Default image if not found
                            }
                            ?>
                        </div>
                        <div class="subcontent col-md-6">
                            <h2 style="color: #0b0b45; font-size: 32px; font-weight: bold;">Technical Events</h2>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Step into the world of innovation and knowledge – participate in our technical events to broaden your skill set!
                            </p>
                            
                            <br><br>
                            <?php
                            $tech_id = 1;
                            echo '<a class="btn btn-primary" style="background-color: #0b0b45; color: #ffffff;" href="viewEvent.php?id=' . $tech_id . '"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Technical Events</a>';
                            ?>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr style="border-top: 2px solid #00008B;">
                </div>
            </div>

            <!-- Gaming Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <?php
                            $game_image = "images/game.jpg"; // Default image
                            if (file_exists($game_image)) {
                                echo '<img src="' . $game_image . '" class="img-responsive">';
                            } else {
                                echo '<img src="default_image.jpg" class="img-responsive">'; // Default image if not found
                            }
                            ?>
                        </div>
                        <div class="subcontent col-md-6">
                            <h2 style="color: #0b0b45; font-size: 32px; font-weight: bold;">Gaming Events</h2>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Unleash your competitive spirit and immerse yourself in the excitement of our different gaming events!
                            </p>
                            
                            <br><br>
                            <?php
                            $game_id = 2;
                            echo '<a class="btn btn-primary" style="background-color: #0b0b45; color: #ffffff;" href="viewEvent.php?id=' . $game_id . '"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Gaming Events</a>';
                            ?>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr style="border-top: 2px solid #00008B;">
                </div>
            </div>

            <!-- Main Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <?php
                            $main_image = "images/mainevent.jpg"; // Default image
                            if (file_exists($main_image)) {
                                echo '<img src="' . $main_image . '" class="img-responsive">';
                            } else {
                                echo '<img src="default_image.jpg" class="img-responsive">'; // Default image if not found
                            }
                            ?>
                        </div>
                        <div class="subcontent col-md-6">
                            <h2 style="color: #0b0b45; font-size: 32px; font-weight: bold;">Main Events</h2>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Ignite your self-confidence and make a lasting impression by participating in our unique and engaging main events!
                            </p>
                            
                            <br><br>
                            <?php
                            $main_id = 3;
                            echo '<a class="btn btn-primary" style="background-color: #0b0b45; color: #ffffff;" href="viewEvent.php?id=' . $main_id . '"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Main Events</a>';
                            ?>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr style="border-top: 2px solid #00008B;">
                </div>
            </div>

            <!-- Fun Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <?php
                            $fun_image = "images/fun.jpg"; // Default image
                            if (file_exists($fun_image)) {
                                echo '<img src="' . $fun_image . '" class="img-responsive">';
                            } else {
                                echo '<img src="default_image.jpg" class="img-responsive">'; // Default image if not found
                            }
                            ?>
                        </div>
                        <div class="subcontent col-md-6">
                            <h2 style="color: #0b0b45; font-size: 32px; font-weight: bold;">Fun Events</h2>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Join the fun and let your talents shine in our exciting lineup of events designed to bring out the best in every participant!
                            </p>
                            
                            <br><br><br>
                            <?php
                            $fun_id = 4;
                            echo '<a class="btn btn-primary" style="background-color: #0b0b45; color: #ffffff;" href="viewEvent.php?id=' . $fun_id . '"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Fun Events</a>';
                            ?>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
        </div><!-- body content div -->
  
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
