@section('title')
    Things
@endsection
<div>
    <div class="row mt-4">
        <div class="d-flex justify-content-center">
            <div class="card shadow-2-strong rounded-3 w-50">
                <div class="card-body p-5">
                    <ul drag-group="reorder" class="list-unstyled">
                        @foreach ($things as $thing)
                            <li drag-item="{{ $thing['id'] }}" draggable="true" wire:key='{{ $thing['id'] }}'
                                class="list-item py-3 my-1 f-400 rounded-3 px-4 hover-shadow">
                                {{ $thing['title'] }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let root = document.querySelector('[drag-group]');

    root.querySelectorAll('[drag-item]').forEach(el => {
        el.addEventListener('dragstart', e => {
            e.target.classList.add('drag-start');
            e.target.setAttribute('dragging', true);
        });

        el.addEventListener('drop', e => {
            e.target.classList.remove('drag-enter');

            let draggingEl = root.querySelector("[dragging='true']");
            e.target.before(draggingEl);

            let component = Livewire.find(
                e.target.closest("[wire\\:id]").getAttribute('wire:id')
            );

            let orderIds = Array.from(root.querySelectorAll("[drag-item]"))
                .map(itemEl => itemEl.getAttribute('drag-item'));
            let method = root.getAttribute('drag-group');
            component.call(method, orderIds);
        });

        el.addEventListener('dragover', e => {
            e.preventDefault();
        });

        el.addEventListener('dragenter', e => {
            e.target.classList.add('drag-enter');
            e.preventDefault()
        });

        el.addEventListener('dragleave', e => {
            e.target.classList.remove('drag-enter');
        });

        el.addEventListener('dragend', e => {
            e.target.classList.remove('drag-start');
            e.target.removeAttribute('dragging');
        });
    });

</script>
