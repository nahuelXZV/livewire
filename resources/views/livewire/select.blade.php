<div>

    {{ $pais }}
    <div class="mb-4" wire:ignore>
        <label for="id_label_single">
            Selecciona un PAIS <br>
            <select wire:model='pais' class="select2" style="width: 50%">
                <option value="PE">Peru</option>
                <option value="AR">Argentina</option>
                <option value="CH">Chile</option>
                <option value="BO">Bolivia</option>
                <option value="VE">Venezuela</option>
            </select>
        </label>
    </div>

    <div>
        <input type="text" wire:model="ciudad">
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true,
                minimumInputLength: 3,
            });
            $('.select2').on('change', function() {
                @this.set('pais', this.value);
            })
        })
    </script>
</div>
