<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Impression de la reservation</title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Invoicebus Invoice Template">
    <meta name="author" content="Invoicebus">

    <meta name="template-hash" content="f3142bbb0a1696d5caa932ecab0fc530">

    <link rel="stylesheet" href="{{ asset('assets_invoice/css/template.css')}}">
  </head>
  <body>
    <div id="container">
      <section id="memo">
        <div class="company-name">
          <span>Miray Geek</span>
          <div class="right-arrow"></div>
        </div>

        <div class="logo">
          <img src="{{ asset('assets_cli/images/logo.jpg')}}" data-logo="" />
        </div>
        
        <div class="company-info">
          <div>
            <span>Isaha</span> <span>Fianarantsoa</span>
          </div>
          <div>email@gmail.com</div>
          <div>034 78 787 88</div>
        </div>

      </section>
    @foreach($resListe as $liste)  
      <section id="invoice-info">
        <div>
          <span>Date Debut:</span>
          <span>Date Fin:</span>
          <span>Jour:</span>
          
          <span>Status:</span>
         
        </div>
        
        <div>
          <span>{{ date('j F Y',strtotime($liste->date_debut)) }}</span>
          <span>{{ date('j F Y',strtotime($liste->date_fin)) }}</span>
          <span>{{ $liste->nbr_jour }}</span>
         
          <span>{{ $liste->status }}</span>
        </div>
      </section>
      
      <section id="client-info">
        <span>Info sur le client</span>
        <div>
          <span class="bold">{{ $liste->name  }} {{ $liste->prenom_cli  }}</span>
        </div>
        
        <div>
          <span>{{ $liste->pays_cli  }} {{ $liste->ville_cli  }} {{ $liste->adrs_cli }} {{ $liste->code_postal_cli }}</span>
        </div>
        
      
        <div>
          <span>{{ $liste->tel_cli  }}</span>
        </div>
        
        <div>
          <span>{{ $liste->email }}</span>
        </div>
        
      
      </section>
      
      <div class="clearfix"></div>
      
      <section id="invoice-title-number">
      
        <span id="title">Reservation N°:</span>
        <span id="number">{{ $liste->id }}</span>
        
      </section>
      
      <div class="clearfix"></div>
      
      <section id="items">
        
        <table cellpadding="0" cellspacing="0">
        
          <tr>
            <th style="width:69px">N° chambre</th> <!-- Dummy cell for the row number and row commands -->
            <th>Description</th>
            <th>Nombre lit</th>
            <th>Etage</th>
            <th>Categorie ID</th>
            <th>Description</th>
          
          </tr>
          
          <tr data-iterate="item">
            <td>{{ $liste->num_ch }}</td> <!-- Don't remove this column as it's needed for the row commands -->
            <td>{{ $liste->description_ch }}</td>
            <td>{{ $liste->nbr_lit_ch }}</td>
            <td>{{ $liste->etage_ch }}</td>
            <td>{{ $liste->categorie_id }}</td>
            <td>{{ $liste->desc}}</td>
          
          </tr>
          
        </table>
        
      </section>
   
      <div class="currency">
        <span></span> <span>Informaion sur le chambre</span>
      </div>
    @endforeach  
    @foreach($resListe as $rese)   
      <section id="sums">
  
        <table cellpadding="0" cellspacing="0">
          <tr>
            <th>Prix une journé:</th>
            <td>{{ $rese->montant / $rese->nbr_jour }} Ar </td>
          </tr>
  
      
          <tr data-iterate="tax">
            <th>Nombre de jour</th>
            <td>{{ $rese->nbr_jour }} jours</td>
          </tr>
        
          <tr class="amount-total">
            <th>Montant sur la reservation</th>
            <td>{{ $rese->montant }}Ar</td>
          </tr>

          <tr data-iterate="tax">
          <td><a href="{{ route('reservation.print_id',['id'=>$liste->id]) }}" target="_blank" style="text-align: center;text-decoration: none;background-color: #b7b3ac;padding: 14px;width: 30%; color: white;">IMPRIMER</a></td>
          </tr>
     
        
          
        </table>
        
      </section>
      @endforeach     
      <div class="clearfix"></div>
      
      <section id="terms">
      
        <span>Information</span>
        <div>Mercie pour la reservaion veuillez patienter pour l' acceptation de la reservation</div>
        
      </section>

     
   
    </div>

    <script type="text/javascript"> 
      window.addEventListener("load", window.print());
    </script>
  </body>
</html>
