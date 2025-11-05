@extends('web/layout/index')

@section('conteudo')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Mercado Livre</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
          <li class="breadcrumb-item active">Mercado Livre</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Pedidos</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID do M.L.</th>
                  <th>Data do Pedido</th>
                  <th>Comprador Apelido</th>
                  <th>Valor Total</th>
                  <th>Valor Pago</th>
                  <th>ID de Envio</th>
                  <th>Entrega Custo</th>
                  <th>Status</th>
                  <th style="width: 40px">Ver</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($pedidos as $pedido)
                  <?php
                    if ($pedido->status == 'paid') {
                      $bg = 'bg-success';
                    }else {
                      $bg = 'bg-danger';
                    }
                  ?>
                  <tr>
                    <td>{{ $pedido->id_ml }} </td>
                    <td> <span class="badge bg-primary"> {{ date('d/m/Y', strtotime($pedido->data_criacao)) }} </span> <span class="badge bg-success"> {{ date('H:i', strtotime($pedido->data_criacao)) }} </span> </td>
                    <td> {{ $pedido->comprador->apelido ?? 'Sem nome' }} </td>
                    <td> R$ {{ $pedido->valor_total }} </td>
                    <td> R$ {{ $pedido->valor_pago }} </td>
                    <td>{{ optional($pedido->envio)->id_ml ?? 'N/A' }}</td>
                    <td>
                        @php
                            $custoEntrega = 'N/A';
                            foreach ($shipments as $shipment) {
                                if (optional($pedido->envio)->id_ml == $shipment->id_ml) {
                                    $custoEntrega = 'R$ ' . number_format($shipment->base_cost, 2, ',', '.');
                                    break;
                                }
                            }
                        @endphp
                        {{ $custoEntrega }}
                    </td>
                    <td> <span class="badge {{ $bg  }}"> {{ $pedido->status }} </span> </td>
                    <td> <button type="button" class="btn text-primary" data-toggle="modal" data-target="#modal-pedido{{ $pedido->id }}"> <i class="nav-icon far fa-eye"></i> </button> </td>
                  </tr>

                  <!-- modal pedidos -->
                  <div class="modal fade" id="modal-pedido{{ $pedido->id }}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"> <b> Pedido: </b> {{ $pedido->id_ml }} </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- START ALERTS AND CALLOUTS -->

                          <div class="row">

                            <div class="col-md-9">
                              <div class="callout callout-info">
                                {{-- <h5></h5> --}}
                                <p>
                                  <b>Comprador</b> <br>
                                  <b>Apelido: </b> {{ $pedido->comprador->apelido ?? 'Sem nome' }} <br>
                                  <b>ID: </b> {{ $pedido->comprador->id_ml ?? 'Sem ID' }}
                                </p>
                              </div>
                            </div>
                              <div class="col-md-3">
                                @if ( $pedido->status == "cancelled" )

                                    <div class="alert alert-danger alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-ban"></i> Cancelado </h5>
                                      Pedido foi cancelado
                                    </div>
                                    
                                    
                                @elseif ($pedido->status == "paid")

                                    <div class="alert alert-success alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-check"></i> Pago </h5>
                                      Pedido pago
                                    </div>
                                                                  
                                @else

                                    <div class="alert alert-warning alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                      Alguma coisa diferente de pago ou cancelado que não sabemos 
                                    </div>
                                    
                                @endif

                                <!-- /.card -->
                              </div>
                              <!-- /.col -->
                          </div>
                          <!-- /.row -->


                          <div class="row">
                            <div class="col-md-6">
                              <div class="callout callout-info">
                                <div class="card-header">
                                  <h3 class="card-title">
                                    <i class="fas fa-clipboard-list"></i> &nbsp;
                                    Detalhes do pedido
                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <p><b>Data do pedido </b> {{ date('d M Y ', strtotime($pedido->data_criacao)) }}  <b>&nbsp; ás &nbsp;</b> {{ date('H:i', strtotime($pedido->data_criacao)) }}  </p>
                                  <p><b>Valor Total do pedido:  </b> <h4> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }} </h4></p>
                                  <p><b>Valor Pago:  </b> <h4> R$ {{ number_format($pedido->valor_pago, 2, ',', '.') }} </h4></p>
                                  <p><b>Itens:  </b> </p>
                                  @foreach ($pedido->itens as $item)
                                    
                                  <!-- small box -->
                                    <div class="small-box bg-info">
                                      <div class="inner">
                                       
                                        <p>Valor Completo Unidade</p>
                                        <h3>R$ {{ number_format($item->preco_unitario_completo, 2, ',', '.') }} </h3>

                                        <p>
                                          <b> Item:</b>  {{ $item->titulo }} <br>
                                          <b> ID:</b>  {{ $item->item_id }} <br>
                                          <b> Quantidade: </b> {{ $item->quantidade }} <br>
                                          <b> Dias fabricação: </b> {{ $item->dias_fabricacao }} <br>
                                          <b> Valor Unidade: </b> R$ {{ number_format($item->preco_unitario, 2, ',', '.') }} <br>
                                          <b> Taxa de Venda: </b> {{ $item->taxa_venda }} % <br>
                                          <b> {{ $item->garantia }}</b>  <br>
                                        </p>
                                        
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                      
                                    </div>

                                  @endforeach
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                              <div class="callout callout-info">
                                <div class="card-header">
                                  <h3 class="card-title">
                                    <i class="fas fa-truck"></i> &nbsp;
                                    Detalhes da entrega
                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  @foreach ($shipments as $shipment)
                                      @if (optional($pedido->envio)->id_ml == $shipment->id_ml)
                                          <!-- small box -->
                                          <div class="small-box bg-warning">
                                              <div class="inner">
                                                  <p>Custo Base</p>
                                                  <h3>R$ {{ number_format($shipment->base_cost, 2, ',', '.') }}</h3>
                                                  <p><b>ID:</b> {{ $shipment->id_ml }}</p>
                                              </div>
                                              <div class="icon"><i class="fas fa-truck"></i></div>
                                          </div>
                                      @endif
                                  @endforeach

                                  <!-- Timelime  -->
                                  @foreach ($shipments as $shipment)
                                    @foreach ($shipment->substatusHistories as $shipmentSub)
                                        @if (optional($pedido->envio)->id_ml == $shipmentSub->id_ml)

                                          <?php
                                          
                                          if ($shipmentSub->substatus == "shipment_paid") {
                                            $fa = "fa-money-bill-wave";
                                            $descricao = "Transporte Pago";
                                          } else if ($shipmentSub->substatus == "invoice_pending") {
                                            $fa = "fa-file-invoice";
                                            $descricao = "Aguardando Aprovação";
                                          } else if ($shipmentSub->substatus == "waiting_for_carrier_authorization") {
                                            $fa = "fa-truck";
                                            $descricao = "Aguardando Autorização do Entregador";
                                          } else if ($shipmentSub->substatus == "ready_to_print") {
                                            $fa = "fa-print";
                                            $descricao = "Pronto para impressão";
                                          } else if ($shipmentSub->substatus == "dropped_off") {
                                            $fa = "fa-people-carry";
                                            $descricao = "Entregue"; 
                                          } else if ($shipmentSub->substatus == "picked_up") {
                                            $fa = "fa-people-carry";
                                            $descricao = "Retirado"; 
                                          } else if ($shipmentSub->substatus == "in_hub") {
                                            $fa = "fa-building";
                                            $descricao = "No hub"; 
                                          } else if ($shipmentSub->substatus == "in_packing_list") {
                                            $fa = "fa-box";
                                            $descricao = "Na empacotamento"; 
                                          } else {
                                            $fa = "times";
                                            $descricao = "Sem descrição"; 
                                          }


                                          
                                          
                                          ?>
                                            
                                          <!-- The time line -->
                                          <div class="timeline">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                              <span class="bg-red">{{ date('d/m/Y ', strtotime($shipmentSub->date)) }} </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                              <i class="fas {{ $fa }} bg-blue"></i>
                                              <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> {{ date('h:m ', strtotime($shipmentSub->date)) }}</span>
                                                <h4 class="timeline-header">{{ $descricao }}</h4>
                                                
                                              </div>
                                            </div>
                                            <!-- END timeline item -->
                                            
                                            <div>
                                              <i class="fas fa-clock bg-gray"></i>
                                            </div>
                                          </div>
                                          <!-- /.col -->

                                        @endif
                                    @endforeach
                                  @endforeach
                                          
                                      <!-- /.timeline -->

                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                          </div>

                          <!-- END ALERTS AND CALLOUTS -->
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal pedidos -->
                    
                @endforeach
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection