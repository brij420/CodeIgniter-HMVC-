<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Kliklikes</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

            <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="js/jquery.simpleSlider.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#slider').simpleSlider({
                        width: 760,
                        height: 332
                    });
                });
            </script>

            <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
            <link rel="stylesheet" type="text/css" href="css/skin.css">
                <script type="text/javascript">
                    function mycarousel_initCallback(carousel)
                    {
                        carousel.buttonNext.bind('click', function() {
                            carousel.startAuto(0);
                        });

                        carousel.buttonPrev.bind('click', function() {
                            carousel.startAuto(0);
                        });
                        carousel.clip.hover(function() {
                            carousel.stopAuto();
                        }, function() {
                            carousel.startAuto();
                        });
                    }
                    ;

                    jQuery(document).ready(function() {
                        jQuery('#mycarousel').jcarousel({
                            auto: 3,
                            wrap: 'last',
                            initCallback: mycarousel_initCallback
                        });


                    });

                </script>
                <script type="text/javascript">
                    function mycarousel_initCallback(carousel)
                    {
                        carousel.buttonNext.bind('click', function() {
                            carousel.startAuto(0);
                        });

                        carousel.buttonPrev.bind('click', function() {
                            carousel.startAuto(0);
                        });
                        carousel.clip.hover(function() {
                            carousel.stopAuto();
                        }, function() {
                            carousel.startAuto();
                        });
                    }
                    ;

                    jQuery(document).ready(function() {
                        jQuery('#mycarousel1').jcarousel({
                            auto: 4,
                            wrap: 'last',
                            initCallback: mycarousel_initCallback
                        });


                    });

                </script>
                </head>

               
                </html>