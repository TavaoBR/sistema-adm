<?php 

function routerConfig():string
{
    $rota = "http://localhost/sistema-adm";
    return $rota;
}


function LinkCdn(){
    $link = routerConfig()."/Public/";
    return $link;
 }
 
 function Assests(string $path){
     echo LinkCdn()."{$path}";
 }

function redirect(string $to){
    return header("Location: {$to}");
}

function redirectBack(){
    $paginaAnterior = $_SERVER['HTTP_REFERER'];
    return header("Location: {$paginaAnterior}"); 
}


function messageSuccess(string $message, string $id = null){
    $alerta = "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    {$message}
    </div>

  ";
   return $alerta;
}

function messageError(string $message, string $id = null){
   $alerta = "<p class='alert alert-danger' id='{$id}'>{$message}</p>";
   return $alerta;
}

function messageWarning(string $message, string $id = null){
    $alerta = "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    {$message}
    </div>

  ";
   return $alerta;
}


function sweetAlertSuccess(string $message, string $title = null){

    if($title == "" OR $title == null){
        $title = "Não está esquecendo algo";
     }

    $sweet = "
    <script>

    function alert(){
        Swal.fire({
            icon: 'success',
            title: '$title',
            text: '$message',
          });
    }

    alert();
    
    </script>
";

return $sweet;
}

function sweetAlertWarning(string $message, string $title = null){
   
    if($title == "" OR $title == null){
       $title = "Não está esquecendo algo";
    }

    $sweet = "
    <script>

    function alert(){
        Swal.fire({
            icon: 'info',
            title: '$title',
            text: '$message',
          });
    }

    alert()

   
    </script>
";

return $sweet;
}

function sweetAlertError(string $message){
  $sweet = "
      <script>
      function alert(){
        Swal.fire({
            icon: 'error',
            title: 'Ocorreu um erro',
            text: '$message',
          });
      }

      alert()
        
     
      </script>
  ";
  
  return $sweet;
}


function formatarNumero($numero) {
    if ($numero >= 1000000000) {
        // Bilhões
        $valor = $numero / 1000000000;
        $sufixo = 'B';
    } elseif ($numero >= 1000000) {
        // Milhões
        $valor = $numero / 1000000;
        $sufixo = 'M';
    } elseif ($numero >= 1000) {
        // Milhares
        $valor = $numero / 1000;
        $sufixo = 'K';
    } else {
        // Menor que mil
        return (string)$numero;
    }

    // Formatar o valor para uma representação adequada
    if ($valor == (int)$valor) {
        // Se o valor é inteiro, não mostrar casas decimais
        return (int)$valor . $sufixo;
    } else {
        // Caso contrário, mostrar no máximo duas casas decimais
        return number_format($valor, 2, '.', '') . $sufixo;
    }
}


function gerarSenha(int $comprimento) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&';
    $senha = '';
    $max = strlen($caracteres) - 1;
    
    for ($i = 0; $i < $comprimento; $i++) {
        $indice = rand(0, $max);
        $senha .= $caracteres[$indice];
    }
    
    return $senha;
}




function diaSemanaEmPortugues($diaIngles) {
    $diasDaSemana = [
        'Monday' => 'Segunda-feira',
        'Tuesday' => 'Terça-feira',
        'Wednesday' => 'Quarta-feira',
        'Thursday' => 'Quinta-feira',
        'Friday' => 'Sexta-feira',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];
    
    return $diasDaSemana[$diaIngles];
}


function statusAgendamento(int $status){

    switch($status){
        case 1:
            $status = "Novo agendamento";
        break;
        
        case 2:
           $status = "Aguardando Confirmação Cliente";
        break;

        case 3:
            $status = "Cancelado";
        break;    

        case 4: 
            $status = "Presença Confirmada";
        break;    

        case 5:
            $status = "Concluido";
        break;    
    }

    return $status;

} 

function statusAgendamentoColor(int $status){

    switch($status){
        case 1:
            $status = "background-color: #6C757D; color:#fff";
        break;
        
        case 2:
           $status = "background-color: #6C757D; color:#fff";
        break;

        case 3:
            $status = "background-color: #DC3545; color:#fff";
        break;    

        case 4: 
            $status = "background-color: #6C757D; color:#fff";
        break;    

        case 5:
            $status = "background-color: #198754; color:#fff";
        break;    
    }

    return $status;

} 


function statusBarbeiro(int $status)
{

    switch($status){
       case 1:
         $status = "Ativo";
       break; 

       case 2:
         $status = "Inativo";
       break; 

       case 3:
         $status = "Folga";
       break; 
    }

    return $status;

}

function mediaNota(int $total, int $valor)
{
    $divide = $valor / $total;
    return number_format($divide, 1);
}