  <div>
    <x-table.table-ppal>
	  	<x-table.header.header-menu-left-select :selected="$selected">
		  </x-table.header.header-menu-left-select>
	  	<x-table.header.header-menu-right>
        <x-table.header.header-menu-right-search>
          <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="Búsqueda por nombre..." wire:model="filters.address">
        </x-table.header.header-menu-right-search>
		  	<x-table.header.header-menu-right-button>
		  		{{__('Sincronizar')}}
		  	</x-table.header.header-menu-right-button>
		  </x-table.header.header-menu-right>
		</div>
		<div>
			<x-table.table-list>
					<table class="min-w-full leading-normal">
						<thead>
                <tr>
                  <x-card.grid-card>
                    @foreach ($paginate as $estate)
                      @if ($estate->purposeStatus->id=='3' || $estate->purposeStatus->id=='17')
                        <x-card.body :estate="$estate" :status="$status['sold']['card']">
                        </x-card.body>
                      @elseif ($estate->purposeStatus->id=='5' || $estate->purposeStatus->id=='16')
                        <x-card.body :estate="$estate" :status="$status['under-offer']['card']">
                        </x-card.body>
                      @elseif ($estate->purposeStatus->id=='12')
                        <x-card.body :estate="$estate" :status="$status['owner-s']['card']">
                        </x-card.body>
                      @elseif ($estate->purposeStatus->id=='13')
                        <x-card.body :estate="$estate" :status="$status['owner-r']['card']">
                        </x-card.body>
                      @elseif ($estate->purposeStatus->id=='1' || $estate->purposeStatus->id=='15')
                          <x-card.body :estate="$estate" :status="$status['for-sale']['card']">
                          </x-card.body>
                      @else
                          <x-card.body :estate="$estate" :status="$status['other']['card']">
                          </x-card.body>
                      @endif


                @endforeach
                </x-card.grid-card>
  						  </tr>

						</thead>
					</table>
          {{ $paginate->links('pagination',['is_livewire' => true]) }}
      </x-table.table-list>
	</x-table.table-ppal>
</div>
