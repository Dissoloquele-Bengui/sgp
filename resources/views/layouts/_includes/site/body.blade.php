<!DOCTYPE html>
<html lang="en">
@include('layouts._includes.site.head')

<body>
    <!-- ////////////////////////////////////////////////////////////////////////////////////////
                               START SECTION 1 - THE NAVBAR SECTION
/////////////////////////////////////////////////////////////////////////////////////////////-->
@include('layouts._includes.site.menu')
 @yield('conteudo')

    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////
                            START SECTION 2 - THE INTRO SECTION
/////////////////////////////////////////////////////////////////////////////////////////////////////-->



    <!-- ///////////////////////////////////////////////////////////////////////////////////////////
                           START SECTION 9 - THE FOOTER
///////////////////////////////////////////////////////////////////////////////////////////////-->
@include('layouts._includes.site.footer')
@include('layouts.alert.index')

    <!-- BACK TO TOP BUTTON  -->
    <a href="#" class="shadow btn-primary rounded-circle back-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>




    <script src="/assets/vendors/js/glightbox.min.js"></script>

    <script type="text/javascript">
        const lightbox = GLightbox({
            'touchNavigation': true,
            'href': 'https://www.youtube.com/watch?v=J9lS14nM1xg',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoPlayVideos': 'true',
        });
    </script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    
  <script src="/assets/vendors/js/glightbox.min.js"></script>

  <script type="text/javascript" src="/assets/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/js/form-wizard.js"></script>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
