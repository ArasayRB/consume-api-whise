<div class="{{$status}}">
  <div class="p-6">
    <h5 class="text-lg font-medium">{{__('Nombre de la propiedad')}}:
      @isset($estate->address)
        {{$estate->address}}
      @endisset
    </h5>
    <p class="mt-2">
      {{__('Id de la propiedad')}}-
      @isset($estate->id)
        {{$estate->id}}
      @endisset
    </p>
    <p class="mt-2">
      {{__('Estado de la propiedad')}}-
      @isset($estate->purposeStatus->id)
        {{$estate->purposeStatus->id}}
      @endisset

      @isset($estate->statusSale)
        @if ($estate->statusSale!='')
          ({{$estate->statusSale}})
        @endif
      @endisset

    </p>
    <div class="mt-4 flex">
      <a href="/dashboard/estates/tasks/{{$estate->address}}/{{$estate->id}}/{{$estate->purposeStatus->id}}/{{$estate->statusSale}}" class="btn bg-indigo-600 mr-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">
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
