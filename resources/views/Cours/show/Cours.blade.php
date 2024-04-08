@extends('Layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Voir Tout Les Contenus</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div id="message_containe"></div>
            <div class="row">
                <div class="card card-default col-12">
                    <div class="card-header row">
                        <div class="col-6">
                            <h3 class="card-title">Voir les Contenu</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">


                        <div class="row row-cols-1 row-cols-md-3 g-4 event_conatine">
                            @foreach ($cours as $cour)
                                <div class="col mb-3">
                                    <div class="card h-100 shadow-lg border-0  mb-5 p-0 rounded">
                                        <div class="position-relative">
                                            <h5 class="position-absolute badge badge-success">{{ $cour->isActive ? 'Active' : '' }}</h5>
                                            <h5 class="position-absolute badge badge-warning" style="right: 0">{{ $cour->isComing ? 'A Venir' : '' }}</h5>

                                            <img src="{{ asset('asset/blog.jpeg') }}" class="card-img-top about_img"
                                                alt="Skyscrapers" />

                                        </div>
                                        <div class="card-body text-center">
                                            <h6 class="card-title font-weight-bold ">
                                                {{ $cour->title }}
                                            </h6>
                                            <p class="card-text">
                                                {{ Str::limit($cour->description, '250', '...') }}
                                            </p>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-info w-25 mb-2" href="{{Route('dashboard.cours.show' , Crypt::encrypt($cour->id))}}">Voir</a>
                                        </div>

                                        <div class="card-footer border-0 text-center">

                                            <small class="text-muted categorie-tag">{{$cour->cours_type}}</small>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>


                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                <ul class="pagination justify-content-center m-0">
                                    <li class="page-item ">{{ $cours->links() }}</li>

                                </ul>
                            </nav>
                        </div>



                    </div>
                </div>


            </div>
    </section>
@endsection
