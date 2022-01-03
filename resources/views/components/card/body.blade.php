<div class="{{$status}}">
  <div class="p-6">
    <h5 class="text-lg font-medium">{{__('Nombre de la propiedad')}}:
      @isset($estate->name)
        {{$estate->name}}
      @endisset
    </h5>
    <p class="mt-2">
      {{__('Id de la propiedad')}}-
      @isset($estate->reference_id)
        {{$estate->reference_id}}
      @endisset
    </p>
    <p class="mt-2">
      {{__('Estado de la propiedad')}}-
      @isset($estate->purpose_status)
        {{$estate->purpose_status}}
      @endisset

      @isset($estate->statusSale)
        @if ($estate->statusSale!='')
          ({{$estate->statusSale}})
        @endif
      @endisset

    </p>
    <div class="mt-4 flex">
      <a href="/dashboard/estates/tasks/{{$estate->name}}/{{$estate->reference_id}}/{{$estate->purpose_status}}/{{$estate->statusSale}}" class="btn bg-indigo-600 mr-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
        {{__('Recordatorios')}}
      </a>
      <a href="#" class="btn bg-indigo-600 mr-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
        {{__('Editar')}}
      </a>
      <a href="#" class="btn bg-indigo-600 mr-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
        {{__('Eliminar')}}
      </a>
    </div>
  </div>
</div>
