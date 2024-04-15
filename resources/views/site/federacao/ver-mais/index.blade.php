@extends('layouts.app')
@section('titulo','INACOM')

@section('conteudo')
<section id="center" class="clearfix center_blog">
    <div class="container">
     <div class="row">
      <div class="center_blog_1 clearfix">
       <div class="col-sm-6">
        <div class="center_blog_1l clearfix">
         <h3 class="mgt">Detalhes Sobre a federação {{$federacao->nome}}</h3>	 
        </div>
       </div> 
     
      </div>
     </div>
    </div> 
   </section>
   <section id="blog_detail">
    <div class="container">
     <div class="row">
      <div class="blod_d1 clearfix">
       <div class="col-sm-12">
        <div class="blod_d1lm clearfix">
         <div class="blod_d1l1 clearfix">
          <img src="{{asset($federacao->logo_url)}}" alt="abc" class="iw">
          {{-- <div class="gallery_h  clearfix">
                <h3 class="mgt">Hidden Plans</h3>
                <hr>
          </div> --}}
          <p><?php echo $federacao->descricao?></p>
         
          <ul class="d-ver-mais" >
            <li >    Presidente: {{$federacao->presidente}}  |</li>
            <li >    Telefone: {{$federacao->telefone}}  |</li>
            <li >    E-mail: {{$federacao->email}}  |</li>
            <li >URL do Site:  <a href="{{$federacao->url_site}}"></a> {{$federacao->url_site}} </li>

           </ul>
         </div>
         
      
        </div>
       </div>
  
      </div>
     </div>
    </div>
   </section>
   
   
@endsection
