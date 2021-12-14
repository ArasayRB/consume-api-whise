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
      <x-card.buttons.button>{{__('Recordatorios')}}</x-card.buttons.button>
      <x-card.buttons.button>{{__('Editar')}}</x-card.buttons.button>
      <x-card.buttons.button>{{__('Eliminar')}}</x-card.buttons.button>
    </div>
  </div>
</div>
