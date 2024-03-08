<form id="deleteForm{{$task->id}}" method="post" action="{{ route('tasks.destroy', ['taskId' => $task->id])}}">
    @csrf

    <input form="deleteForm{{$task->id}}" type="hidden" name="_method" value="DELETE">
    <button form="deleteForm{{$task->id}}" type="submit"
            class="p-2 font-semibold rounded-md bg-red-500 text-white text-[17px] text-center">
        Видалити
    </button>
</form>
