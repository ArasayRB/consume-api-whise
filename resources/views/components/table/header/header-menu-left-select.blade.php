<div>
  <select id="currency" name="currency" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md" wire:model="filters.purposeStatus">
    <option>{{__('Seleccione el estado')}}</option>
    @for ($i=0; $i < count($selected)-1; $i++)
      <option>{{$selected[$i]}}</option>
    @endfor
  </select>
</div>
