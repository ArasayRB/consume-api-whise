  <div>
    <x-table.table-ppal>
	  	<x-table.header.header-menu-left-select>
		  </x-table.header.header-menu-left-select>
	  	<x-table.header.header-menu-right>
		  		<x-table.header.header-menu-right-button>
		  			{{__('Sincronizar')}}
		  		</x-table.header.header-menu-right-button>
          <x-table.header.header-menu-right-search>
  		  		<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="Búsqueda por nombre...">
          </x-table.header.header-menu-right-search>
		  </x-table.header.header-menu-right>
		</div>
		<div>
			<x-table.table-list>
					<table class="min-w-full leading-normal">
						<thead>
                <tr>
                  <x-card.grid-card>
                    @foreach ($estates as $estate)
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
					<div
						class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
						<span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
						<div class="inline-flex mt-2 xs:mt-0">
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
							&nbsp; &nbsp;
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
						</div>
					</div>
      </x-table.table-list>
	</x-table.table-ppal>
</div>
