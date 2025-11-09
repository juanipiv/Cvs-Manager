@extends('template.base')

@section('content')

<article class="resume-wrapper text-center position-relative">
	    <div class="resume-wrapper-inner mx-auto text-start bg-white shadow-lg">
		    <header class="resume-header pt-4 pt-md-0">
			    <div class="row">
				    <div class="col-block col-md-auto resume-picture-holder text-center text-md-start">
				        <img class="picture" src="{{ $curriculum->path ? asset('storage/' . $curriculum->path) : asset('assets/img/sin-foto.webp') }}" alt="" style="height:20rem; width:20rem;">
				    </div><!--//col-->
				    <div class="col">
					    <div class="row p-4 justify-content-center justify-content-md-between">
						    <div class="primary-info col-auto">
							    <h1 class="name mt-0 mb-1 text-black text-uppercase text-uppercase">{{ $curriculum->nombre }} {{ $curriculum->apellidos }}</h1>
							    <div class="title mb-3">Nota Media: {{ $curriculum->nota_media }}</div>
							    <ul class="list-unstyled">
								    <li class="mb-2"><a class="text-link" href="#"><i class="far fa-envelope fa-fw me-2" data-fa-transform="grow-3"></i>{{ $curriculum->email }}</a></li>
								    <li><a class="text-link" href="#"><i class="fas fa-mobile-alt fa-fw me-2" data-fa-transform="grow-6"></i>{{ $curriculum->telefono }}</a></li>
							    </ul>
						    </div><!--//primary-info-->
					    </div><!--//row-->
					    
				    </div><!--//col-->
			    </div><!--//row-->
		    </header>
		    <div class="resume-body p-5">
			    <section class="resume-section summary-section mb-5">
				    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Experiencia</h2>
				    <div class="resume-section-content">
					    <p class="mb-0">{{ $curriculum->experiencia }}</p>
				    </div>

				    

				    
			    </section><!--//summary-section-->
			    <div class="row">
				    <div class="col-lg-9">
					    <section class="resume-section experience-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Formación</h2>
                            <div class="resume-section-content">
                                <p class="mb-0">{{ $curriculum->formacion }}</p>
                            </div>
						
					    </section><!--//experience-section-->
				    </div>
			    </div><!--//row-->
			    <div class="row">
				    <div class="col-lg-9">
					    <section class="resume-section experience-section mb-5">
						    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Habilidades</h2>
                            <div class="resume-section-content">
                                <p class="mb-0">{{ $curriculum->habilidades }}</p>
                            </div>
						
					    </section><!--//experience-section-->
				    </div>
			    </div><!--//row-->
		    </div><!--//resume-body-->
		    
		    
	    </div>
    </article>

@endsection