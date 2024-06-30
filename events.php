<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TechFest</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
    <?php require 'utils/eventHeader.php'; ?>
    
    <div class="content">
        <div class="container">
            <div class="col-md-12">
                <h1 style="color: #0b0b45; font-size: 35px; font-style: bold;"><strong>Join the excitement by registering for your favorite events today!</strong></h1>
            </div>
            
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            
            <!-- Technical Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <img src="images/tech.jpg" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6">
                            <h1 style="color: #0b0b45; font-size: 38px;"><u><strong>Technical Events</strong></u></h1>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Step into the world of innovation and knowledge – participate in our technical events to broaden your skill set!
                            </p>
                            
                            <br><br>
                            <a class="btn btn-default" style="background-color: #0b0b45; color: #ffffff" href="viewEvent.php?id=1"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Technical Events</a>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <!-- Gaming Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <img src="images/game.jpg" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6">
                            <h1 style="color: #0b0b45; font-size: 38px;"><strong><u>Gaming Events</u></strong></h1>
                            <p>
                                Unleash your competitive spirit and immerse yourself in the excitement of our different gaming events!
                            </p style="color: #0b0b45; font-size: 18px;">
                            
                            <br><br>
                            <a class="btn btn-default" style="background-color: #0b0b45; color: #ffffff" href="viewEvent.php?id=2"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Gaming Events</a>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <!-- Main Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <img src="images/mainevent.jpg" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6">
                            <h1 style="color: #0b0b45; font-size: 38px;"><strong><u>Main Events</u></strong></h1>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Ignite your self-confidence and make a lasting impression by participating in our unique and engaging main events!
                            </p>
                            
                            <br><br>
                            <a class="btn btn-default" style="background-color: #0b0b45; color: #ffffff" href="viewEvent.php?id=3"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Main Events</a>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
            
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <!-- Fun Events Section -->
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-6">
                            <img src="images/fun.jpg" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6">
                            <h1 style="color: #0b0b45; font-size: 38px;"><strong><u>Fun Events</u></strong></h1>
                            <p style="color: #0b0b45; font-size: 18px;">
                                Join the fun and let your talents shine in our exciting lineup of events designed to bring out the best in every participant!
                            </p>
                            
                            <br><br>
                            <a class="btn btn-default" style="background-color: #0b0b45; color: #ffffff" href="viewEvent.php?id=4"> <span class="glyphicon glyphicon-circle-arrow-right"></span> View Fun Events</a>
                        </div><!-- subcontent div -->
                    </div><!-- container div -->
                </section>
            </div><!-- row div -->
        </div><!-- body content div -->
  
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
