<div class="container-fluid p-0">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Kill Team Campaign</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav pr-2">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Log Out</a>
        </li>
      </ul>
      <form class="form-inline pl-3 my-2 my-lg-0 border-left border-light">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</div>

<div class="container-fluid" style="min-height:100vh">
  <div class="row" style="min-height:100vh">
    <div class="col-md-2 bg-dark text-white pt-5" style="min-height:100vh">
      <nav class="nav flex-column">
        {{ Html::linkRoute('players.index', 'Dashboard', null, ['class'=>'nav-link text-white']) }}
        {{ Html::linkRoute('players.index', 'Players', null, ['class'=>'nav-link text-white']) }}
        {{ Html::linkRoute('rounds.index', 'Rounds', null, ['class'=>'nav-link text-white']) }}
      </nav>
    </div>
    <div class="col-md-8 offset-md-1 pt-5">
    
