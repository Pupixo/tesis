
        <!-- load JS files -->
        <script src=<?php echo base_url("public/web/js/jquery-1.11.3.min.js"); ?>></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src=<?php echo base_url("public/web/js/popper.min.js"); ?>></script>                    <!-- https://popper.js.org/ -->       
        <script src=<?php echo base_url("public/web/js/bootstrap.min.js"); ?>></script>                 <!-- https://getbootstrap.com/ -->
        <script src=<?php echo base_url("public/web/js/datepicker.min.js"); ?>></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src=<?php echo base_url("public/web/js/jquery.singlePageNav.min.js"); ?>></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src=<?php echo base_url("public/web/slick/slick.min.js"); ?>></script>                  <!-- http://kenwheeler.github.io/slick/ -->


        <?php
            switch ($abrev) {
                case 'syllabus':
                    include 'public/js/syllabus.js.php';
                    break;
          
            }
        ?>

        <script>
              


            /* Google map
            ------------------------------------------------*/
            var map = '';
            var center;

            function initialize() {
                var mapOptions = {
                    zoom: 13,
                    center: new google.maps.LatLng(-23.013104,-43.394365),
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

                google.maps.event.addDomListener(map, 'idle', function() {
                calculateCenter();
            });

                google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(center);
            });
            }

            function calculateCenter() {
                center = map.getCenter();
            }

            function loadGoogleMap(){
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWt4rJfibfsEDvcuaChUaZRS5NXey1Cs&v=3.exp&sensor=false&' + 'callback=initialize';
                document.body.appendChild(script);
            } 

            function setCarousel() {
                
                if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                    $('.tm-article-carousel').slick('destroy');
                } 

                if($(window).width() < 438){
                    // Slick carousel
                    $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                }
                else {
                $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    });   
                }
            }

            function setPageNav(){
                if($(window).width() > 991) {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 79
                    });   
                }
                else {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 65
                    });   
                }
            }

            function togglePlayPause() {
                vid = $('.tmVideo').get(0);

                if(vid.paused) {
                    vid.play();
                    $('.tm-btn-play').hide();
                    $('.tm-btn-pause').show();
                }
                else {
                    vid.pause();
                    $('.tm-btn-play').show();
                    $('.tm-btn-pause').hide();   
                }  
            }

            $(document).ready(function(){

                $(window).on("scroll", function() {
                    if($(window).scrollTop() > 100) {
                        $(".tm-top-bar").addClass("active");
                    } else {
                        //remove the background property so it comes transparent again (defined in your css)
                    $(".tm-top-bar").removeClass("active");
                    }
                });      

                // Google Map
                loadGoogleMap();  

                // Date Picker
                //const pickerCheckIn = datepicker('#inputCheckIn');
                //const pickerCheckOut = datepicker('#inputCheckOut');
                
                // Slick carousel
                setCarousel();
                setPageNav();

                $(window).resize(function() {
                setCarousel();
                setPageNav();
                });

                // Close navbar after clicked
                $('.nav-link').click(function(){
                    $('#mainNav').removeClass('show');
                });

                // Control video
                $('.tm-btn-play').click(function() {
                    togglePlayPause();                                      
                });

                $('.tm-btn-pause').click(function() {
                    togglePlayPause();                                      
                });

                // Update the current year in copyright
                $('.tm-current-year').text(new Date().getFullYear());    
                
               
            });

        </script>     

        <script>
            var slides = $(".slide");
            var lastSlideIndex = slides.length-1;
            var currentSlideIndex = 0;
            var defaultTiming = 1000;
            var defaultFadeInTime = 1000;
            var defaultFadeOutTime = 1000;
            // Show slide function
            function showSlide() {
                
                var thisSlide = slides.eq(currentSlideIndex);
                
                // Delays
                var timing = parseFloat(thisSlide.attr("data-timing")) * 1000;	// Transform seconds in milliseconds
                if(isNaN(timing)){timing=defaultTiming; console.log("NOTICE: ----------- data-timing is missing, using default.");}
                var fadeInTime = parseFloat(thisSlide.attr("data-fadein")) * 1000;
                if(isNaN(fadeInTime)){fadeInTime=defaultFadeInTime; console.log("NOTICE: ----------- data-fadein is missing, using default.");}
                var fadeOutTime = parseFloat(thisSlide.attr("data-fadeout")) * 1000;
                if(isNaN(fadeOutTime)){fadeOutTime=defaultFadeOutTime; console.log("NOTICE: ----------- data-fadeout is missing, using default.");}
                
                console.log("Slide: "+currentSlideIndex+":\n Display time: "+timing+" millisec.\n Fadein: "+fadeInTime+" millisec.\n Fadeout: "+fadeOutTime+" millisec.");
                thisSlide.animate({opacity:1},fadeInTime);
                
                // If this slide contains a video
                if(slides.eq(currentSlideIndex).find("video").length > 0){
                    
                    // Prevents more than 1 video to play at the same time
                    $("video").each(function(){
                        console.log("All video paused.")
                        $(this)[0].pause();
                    });
                    
                    // Play this video from the start
                    var thisVideo = slides.eq(currentSlideIndex).find("video")[0];
                    thisVideo.currentTime = 0;
                    console.log("Video playing.");
                    thisVideo.play()
                }
                
                // Prepare for next slide
                currentSlideIndex++;
                
                // Reset to slide 0 if last was reached
                if(currentSlideIndex>lastSlideIndex){
                    currentSlideIndex=0;
                }
                
                setTimeout(function(){
                    // Fade out previous slide
                    var previousSlideIndex = currentSlideIndex-1;
                    
                    
                    // If previous was last slide
                    if(previousSlideIndex == -1){
                        previousSlideIndex = lastSlideIndex;
                    }
                    
                    // If previous slide was set to pause
                    if(slides.eq(previousSlideIndex).attr("data-videopause")=="true"){
                        console.log("Video has been paused.");
                        slides.eq(previousSlideIndex).find("video")[0].pause();
                    }
                    
                    slides.eq(previousSlideIndex).animate({"opacity":0},fadeOutTime);
                    showSlide();
                }, timing);
            }
            // Init
            showSlide();
        </script>

</body>

</html>