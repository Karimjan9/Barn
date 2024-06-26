@extends('template')

@section('style')

    <style>
        .ck-restricted-editing_mode_standard{
            min-height: 500px;
        }
        input[type=radio] {
    width: 30px;
    height: 30px;
    margin: 10px 0 0 0;
}
.form-check-label{
    margin: 10px 0 0 5px;
    font-size: 20px;
}
    </style>

@endsection

@section('script_include_header')

    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>

@endsection

@section('body')




<div class="page-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">  
            <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Jo'natma qo'shish</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('kadr_role.career_update.create') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Yangi jo'natma</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {{-- @dd($prixods) --}}
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <h6 class="mb-0 text-uppercase">Jo'natma qismi</h6>
                    <hr>
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center">
                                <div class="ms-auto">
                                    <a href="{{ route('storekeeper_role.prixod.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus"></i>Jo'natma qo'shish</a>
                                </div>
                            </div>
               
                            <form class="row g-3" method="post" action="{{ route('storekeeper_role.store_all')}}">
                                @csrf
                            
                                <input type="hidden" name="lists" value="{{ json_encode($lists) }}">
                                <input type="hidden" name="prixods" value="{{ json_encode($prixods) }}">

                                <div class="col-md-8 mb-3">
                                    <label for="first_type" class="form-label">Cargo</label>
                
                                            <select name="cargo" id='cargo' class="form-select form-select-lg mb-3">
                                               
                                            @foreach ($cargos as $key=>$cargo)
                                    
                                                
                                            <option value="{{ $cargo->id }}" 
                                                >{{ $cargo->name }} </option>
                    
                                            @endforeach
        
                                            </select> 
                            </div>
                                <div class="col-md-8 mb-3">
                                    <label for="first_type" class="form-label">Yetkazuvchi</label>
                                    
                                            <select name="curer" id='curer' class="form-select form-select-lg mb-3">
                                                <option value="" 
                                                                     >Null</option>
                                            @foreach ($curers as $key=>$curer)
                                    
                                                
                                            <option value="{{ $curer->id }}" 
                                                >{{ $curer->name }} </option>
                    
                                            @endforeach
        
                                            </select> 
                            </div>
                        
                            
                        
                                        <div class="row">
                                            <div class="card-body">
                                                <div class="">
                                                    <table class="table table-bordered align-middle mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th class="fixed_header2 align-middle">#</th>
                                                                <th class="fixed_header2 align-middle">Jihoz turi</th>
                                                                <th class="fixed_header2 align-middle">Jihoz nomi</th>
                                                                <th class="fixed_header2 align-middle">Pul birligi</th>

                                                                <th class="fixed_header2 align-middle">Modillik turi</th>
                                                                <th class="fixed_header2 align-middle">Jihoz soni</th>
                                                                <th class="fixed_header2 align-middle">Narxi</th>
                                                                <th class="fixed_header2 align-middle" >Harakatlar</th>
                                                                <th class="fixed_header2 align-middle" >O'chirish</th>

                                
                                
                                                            </tr>
                                                        </thead>
                                                    
                                                        <tbody>
                                                        @foreach ($lists as $p_key=>$list_one)
                                                            @foreach ($list_one as $key=>$list)
                                                                <tr>
                                                        
                                                                <td>{{ $p_key+1 }}</td>
                                                                <td>{{  $list->name }}</td>
                                                                <td>{{ $list->get_second->name}}</td>
                                                                <td>{{ strtoupper($prixods[$p_key]["currency_name"])?? "so'm" }}</td>
                                                                <td>{{ $list->bodily==1?"Moddiy":"Bo'linmaydi"  }}</td>
                                                                <td>{{$prixods[$p_key]["number"]}}</td>
                                                                <td>{{$prixods[$p_key]["cost"] ?? 0}} so'm</td>
                                                            
                                                                    
                                    
                                                            
                                                                <td> <a href="{{ route('storekeeper_role.prixod.edit',['prixod'=>$p_key]) }}" class="btn btn-sm btn-warning text-white me-2"></i>O'zgartirish</a></td>
                                                                <td>
                                                                    {{-- <form action="{{ route('storekeeper_role.prixod.destroy',['prixod'=>$p_key]) }}" method="post">
                                                                        @method("DELETE")
                                                                        @csrf --}}
                                                                       
                                                                    <input class="btn btn-sm btn-danger confirm-button"  type="button" value="O'chirish" onclick="check({{ $p_key }})" >
                                                                    {{-- </form> --}}
                                                                </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <h4>Jo'natmalar narxi: <span id="totalPrice">0 </span> so'm : Jo'natmalar soni : <span id="totalItem">0 </span> ta  </h4>
                                                    <h4>Valyuta bo'yicha: <span id="totalCurrency">0 </span> birlik  </h4>

                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                            
                            
                                <div class="col-12 mb-3">
                                    <button type="submit" class="btn btn-primary px-5">Saqlash</button>
                                </div>
                                @method("POST")
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div> 
        </div>
  
</div>
@endsection

@section('scripte_include_end_body')
<script>
    var app = @json($prixods);
    // console.log(app);
    var sum_cost=0;
    var sum_item=0;
    var sum_currency_total=0;
    for (const iterator of app) {
         
        sum2=parseInt(iterator.number)*(iterator.cost)*(iterator.currency_value);

        sum_cost=sum_cost+(sum2);

        sum_currency=parseInt(iterator.number)*(iterator.cost);

        sum_currency_total=sum_currency_total+sum_currency;

        sum_item+=parseInt(iterator.number);
             
                }

    // console.log(sum_currency_total);


    document.getElementById("totalPrice").innerHTML = sum_cost;
    
    document.getElementById("totalItem").innerHTML = sum_item;

    document.getElementById("totalCurrency").innerHTML = sum_currency_total.toFixed(2);

   
</script>
 <script>
    function check(key){
        var check = confirm("Are you sure you want to leave?");
        if (check == true) {
            return delete_function(key);
        }
       
    };
 </script>
<script>
   function delete_function(key){
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    $.ajax('{{ route('storekeeper_role.prixod.destroy' , ['prixod'=>'key']) }}',
        {
          
            type: 'delete', // replaced from put
            dataType: "JSON",
            data: {
                "id": key,
                "_method": 'DELETE',
                
            },
            success: function ()
            {
                // console.log("it Work");
                location.reload();
            }
        });
   }
</script>
@endsection