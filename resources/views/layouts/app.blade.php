<!DOCTYPE html>
<html lang="en">
@include('layouts._includes.site.head')
  
<body>
<section id="header">
	@include('layouts._includes.site.menu')
</section>

@yield('conteudo')
<section id="footer">
 <div class="container">
  <div class="row">
   {{-- <div class="footer_1 clearfix">
    <div class="col-sm-3">
	 <div class="footer_1_i clearfix">
	  <h4 class="col bold mgt">Sobre o Comitê</h4>
	  <p>Lorem ipsum dolor sit amet, nam ut vero scribentur, mel veritus omnesque ei. Mutat labores mea ex mei.</p>
	  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut mi.</p>
	  <h5 class="col"><i class="fa fa-headphones"></i>	Call Us 1-234-567-xyzab</h5>
	 </div>
	</div>
	<div class="col-sm-3">
	 <div class="footer_1_i clearfix">
	  <h4 class="col bold mgt">Posts Recentes</h4>
      @foreach (federacoes()->orderBy('id','desc')->limit(4)->get() as $item)
          
	  <div class="footer_1_ii clearfix"><h5 class="col mgt"><a href="#">{{$item->nome}}</a> <span>{{ formatarDataPortugues($item->created_at) }}</span></h5></div>
      @endforeach
	 </div>
	</div>
	
	<div class="col-sm-3">
	 <div class="footer_1_i1 clearfix">
	  <h4 class="col bold mgt">Links</h4>
      <h5><a href="#"><i class="fa fa-chevron-right"></i> About Us</a></h5>
	  <h5><a href="#"><i class="fa fa-chevron-right"></i> Club History</a></h5>
	  <h5><a href="#"><i class="fa fa-chevron-right"></i> Contact Us</a></h5>
	  <h5><a href="#"><i class="fa fa-chevron-right"></i> FAQ</a></h5>
	 </div>
	</div>
	
	<div class="col-sm-3">
	 <div class="footer_1_i2 clearfix">
	  <h4 class="col bold mgt">Nossas Redes Sócias</h4>
	  <p>Lorem ipsum dolor sit amet, nam ut vero scribentur, mel veritus omnesque ei. Mutat labores mea ex mei.</p>
      <ul class="social-network social-circle">
                        <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
       </ul>
	 </div>
	</div>
   </div> --}}
   <div class="footer_2 text-center clearfix">
    <div class="col-sm-12">
	  <p class="mgt col"> © {{date('Y')}} Comitê Olímpico Angola
        . Todos os direitos reservados |Desenvolvide por <a class="col_1" href="">InnoSoft</a></p>
	</div>
   </div>
  </div>
 </div>
</section>

<script>
	$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).ready(function () {
    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();
});

	</script>

<script>
	  $("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
	</script>
</body>
 
</html>
