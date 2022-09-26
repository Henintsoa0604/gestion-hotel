<!DOCTYPE html>
<!--
  Invoice template by invoicebus.com
  To customize this template consider following this guide https://invoicebus.com/how-to-create-invoice-template/
  This template is under Invoicebus Template License, see https://invoicebus.com/templates/license/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Facture</title>
    
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
          <span class="bold">Information sur la reservation</span>
          <span>Date Debut:</span>
          <span>Date Fin:</span>
          <span>Jour:</span>
        
          <span>Status:</span>
          <span class="bold">Information sur la chambre</span>
          <span>Chambre N°:</span>
          <span>Tel chambre:</span>
          <span>Nbr lit:</span>
          <span>Nbr personne:</span>
          
         
        </div>
        
        <div>
          <span></span>
          <span>{{ date('j F Y',strtotime($liste->date_debut)) }}</span>
          <span>{{ date('j F Y',strtotime($liste->date_fin)) }}</span>
          <span>{{ $liste->nbr_jour }}</span>
         
          <span>{{ $liste->status }}</span>
          <span></span>
          <span>{{ $liste->num_ch }}</span>
          <span>{{ $liste->num_tel_ch }}</span>
          <span>{{ $liste->nbr_lit_ch }}</span>
          <span>{{ $liste->nbr_pers }}</span>
        </div>
      </section>
      
      <section id="client-info">
        <span class="bold">Info sur le client</span>
        <div>
          <span >{{ $liste->name  }} {{ $liste->prenom_cli  }}</span>
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
      @endforeach 
      <div class="clearfix"></div>
      
      <section id="invoice-title-number">
      
        <span id="title">Facure N°:</span>
        <span id="number">{{$liste->id}}</span>
        
      </section>
      
      <div class="clearfix"></div>
      <h2 style="    color: brown;text-size-adjust: 51px;font-size: large;">Consommation du client</h1>
      <section id="items">
    
        <table cellpadding="0" cellspacing="0">
        
          <tr>
            <th style="text-align:center">#</th> <!-- Dummy cell for the row number and row commands -->
           
            <th style="text-align:center">Quantité</th>
            <th style="text-align:center">Prix</th>
            <th style="text-align:center">Sous total</th>
         
          
          </tr>
          @foreach($consListe as $cons) 
          <?php
            $number =  $cons->prix_unique ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix= str_replace($a,'',$n);
            
          ?>
          <?php
            $number =  $cons->montant_cons ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_cons= str_replace($a,'',$n);
            
          ?>
          
          <tr data-iterate="item">
            <td style="text-align:center">{{ $cons->id }}</td> <!-- Don't remove this column as it's needed for the row commands -->
         
            <td style="text-align:center" >{{ $cons->quantite_cons}}</td>
            <td style="text-align:center">{{ $prix}}Ar</td>
            <td style="text-align:center">{{ $prix_cons}}Ar </td>
           
          
          </tr>
          @endforeach
        </table>
        
      </section>
      
      <div class="currency">
        <span></span> <span>Information sur la consommation</span>
      </div>
      <div class="clearfix"></div><br><br>
      <h2 style="    color: brown;text-size-adjust: 51px;font-size: large;">Prestation du client</h1>
      <section id="items">
        
        <table cellpadding="0" cellspacing="0">
        
          <tr>
            <th style="text-align:center">#</th> <!-- Dummy cell for the row number and row commands -->
            <th style="text-align:center">Designation</th>
           
            <th style="text-align:center">Sous total</th>
         
          
          </tr>
          @foreach($presListe as $cons)
          <?php
            $number =  $cons->montant_pres ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_pres= str_replace($a,'',$n);
            
          ?>
          <tr data-iterate="item">
            <td style="text-align:center">{{ $cons->id }}</td> <!-- Don't remove this column as it's needed for the row commands -->
            <td style="text-align:center">{{ $cons->designation }} </td>
           
            <td style="text-align:center">{{ $prix_pres}}Ar </td>
           
          
          </tr>
          @endforeach
        </table>
        
      </section>
   
      <div class="currency">
        <span></span> <span>Information sur la prestation</span>
      </div>
      
      <section id="sums">
   
        <table cellpadding="0" cellspacing="0">
        <?php
            $number =  $liste->montant / $liste->nbr_jour ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_jour= str_replace($a,'',$n);
            
          ?>
          <tr>
              <th>Prix une journe de la chambre :</th>
              <td>{{ $prix_jour }}Ar</td>
            </tr>
            <tr>
              <th>Periode de la reservation :</th>
              <td>{{ $liste->nbr_jour }} jours</td>
            </tr>
        @foreach($resListe as $rese)
          <?php
            $number =  $rese->montant ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_t= str_replace($a,'',$n);
            
          ?>
          <tr class="amount-total">
            <th>Montant de la reservation</th>
            <td>{{ $prix_t }}Ar</td>
          </tr>
          
          @endforeach  
          @foreach($consTotal as $con) 
          <?php
            $number =  $con->sum;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $sum= str_replace($a,'',$n);
            
          ?>
          <tr>
            <th>Montant de la consommation</th>
            <td>{{ $sum }}Ar</td>
          </tr>
         
          @endforeach  
          @foreach($presTotal as $pre) 
          <?php
            $number =  $pre->sum ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_s= str_replace($a,'',$n);
            
          ?>
          <tr>
            <th>Montant de la prestation</th>
            <td>{{ $prix_s }}Ar</td>
          </tr>
         
          @endforeach  
          <?php
            $number =  $rese->montant + $con->sum +  $pre->sum ;
            $n=  str_replace(',',' ', number_format($number,3));
            $a = strstr($n, '.');
            $prix_ss= str_replace($a,'',$n);
            
          ?>
          <tr class="amount-total">
            <th>Montant total</th>
            <td>{{ $prix_ss }}Ar</td>
          </tr>
         
        </table>
       
    
       
         
      </section>
    
      <div class="clearfix"></div>
      
      <section id="terms">
      
        <span>Information</span>
        @foreach($resListe as $rese)
        <div>Date de payment :   {{ date('j F Y',strtotime($liste->date_paye)) }}</span>
        @endforeach
        
      </section>

     
   
    </div>
    <script type="text/javascript"> 
      window.addEventListener("load", window.print());
    </script>
  
  </body>
</html>


   
