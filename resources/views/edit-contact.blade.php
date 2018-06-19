<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edição de contato</title>

        <!-- Fonts -->
        @include('links')
    </head>
    <body>
        <header>
            @include('navbar-menu')
        </header>
        <main class="main">

             <div class="container row" >
                <h1 class="text-center col-lg-12 p-3">Editar contato</h1>
                 <p class="text-center col-lg-12">Os campos de nome e pelo menos o <strong>primeiro</strong> telefone são <strong>obrigatórios</strong></p>
                <form class="col-lg-12" id="form-contact" novalidate enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <div class="image-preview-container">
                            <label for="picture-file" style="text-align:center;display:block">Alterar Foto:</label>
                            <div style="position: relative" class="mx-auto w-100">
                                <img class="image-preview" src="/img/default-user.png" id="image-preview" alt="">
                                <button type="button" hidden="" id="close-btn" class="close" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                        </div>
                        <input type="file" hidden class="form-control-file" id="picture-file">
                    </div>
                     <div class="form-group">
                        <label for="name">*Nome:</label>
                        <input type="text" class="form-control" id="name" placeholder="Nome" required>
                        <div class="invalid-feedback">
                          O nome é obrigatório.
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" placeholder="email@gmail.com">
                        <div class="invalid-feedback">
                          O e-mail deve ser válido.
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="address">Endereço:</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Rua Plinio Colorado da costa..."></textarea>
                      </div>
                       <div class="form-group">
                        <label for="info">Informações:</label>
                        <textarea class="form-control" id="info" rows="3" placeholder="Informações..."></textarea>
                      </div>
                      <p>*Telefones:</p>
                      <div class="form-row">

                          <div class="form-group col-md-4">
                            
                              <input type="text" id="phone-1" class="form-control" placeholder="(99) 99999-9999" required>
                              <div class="invalid-feedback">
                                  O primeiro telefone é obrigatório.
                                </div>
                          </div>
                          <div class="col-md-4 form-group">
                              <input type="text" id="phone-2" class="form-control phone-secundary" placeholder="(99) 99999-9999">
                              <div class="invalid-feedback">
                                  Digite o telefone completo por favor.
                                </div>
                          </div>
                          <div class="col-md-4 form-group">
                              <input type="text" id="phone-3" class="form-control phone-secundary" placeholder="(99) 99999-9999">
                              <div class="invalid-feedback">
                                  Digite o telefone completo por favor.
                                </div>
                          </div>
                      </div>
                      <button class="btn btn-primary float-right p-2 w-25" type="submit" id="btn-submit">Salvar</button>
                      <div class="clearfix"></div>
                </form>
             </div>
        </main>
   
           
        <footer>
            @include('footer')
            <script src="{{asset('js/libs/jquery.mask.min.js')}}"></script>
            <script src="{{asset('js/model/User.js')}}"></script>
            <script src="{{asset('js/controller/contact.js')}}"></script>
            <script src="{{asset('js/controller/edit-contact.js')}}"></script>
        </footer>
    </body>
</html>

