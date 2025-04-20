<div>
    You don't have your information added. Please enter your information
    <div>
        <div class="mt-5 p-4 bg-gray-300 rounded-lg">
            {{$this->form}}
        </div>
        <div class="flex mt-4 justify-end ">
            <button wire:click="submitInfo" wire:confirm="Are you sure you want to submit this information?" class="px-4 py-3 bg-blue-500 text-white font-semibold rounded-lg">Submit</button>
        </div>    
    </div>
    
</div>
