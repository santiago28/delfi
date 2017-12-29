    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sistema de Información Financiera 2017</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          
		{{ form("index/login", "method":"post", "class":"navbar-form navbar-right", "data-parsley-validate" : "") }}		
           
		   <div class="form-group">
              <input type="text" name="username" placeholder="Usuario" class="form-control" required>
            </div>
			
            <div class="form-group">
              <input type="password" name="passincodificar" placeholder="Contraseña" class="form-control" required>
            </div>
			
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
			
        </form>
       

	   </div><!--/.navbar-collapse -->
      </div>
    </nav>

    
	
	
	<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
	  {{ image("img/delfi.png", "alt": "logo Login", "width":"850", "height":"450") }}
      </div>
    </div>



