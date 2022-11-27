<x-app-layout>
    <div class="container">
        <div class="col-6 mx-auto">
            <h2>メモ編集</h2>
            <form action="{{ route('memo.update', $memo) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" placeholder="ここにメモを入力">{{ old('content', $memo->content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    重要度：
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority1" value="{{ \App\Models\Memo::PRIORITY_LOW }}" @if(old('priority', $memo->priority) == \App\Models\Memo::PRIORITY_LOW) checked @endif>
                        <label class="form-check-label" for="priority1">★</label>
                    </div>
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority2" value="{{ \App\Models\Memo::PRIORITY_MIDDLE }}" @if(old('priority', $memo->priority) == \App\Models\Memo::PRIORITY_MIDDLE) checked @endif>
                        <label class="form-check-label" for="priority2">★★</label>
                    </div>
                    <div class="form-check form-check-inline @error('priority') is-invalid @enderror">
                        <input class="form-check-input" type="radio" name="priority" id="priority3" value="{{ \App\Models\Memo::PRIORITY_HIGH }}" @if(old('priority', $memo->priority) == \App\Models\Memo::PRIORITY_HIGH) checked @endif>
                        <label class="form-check-label" for="priority3">★★★</label>
                    </div>
                    @error('priority')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">期限：</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" id="deadline" value="{{ old('deadline', $memo->deadline->format('Y-m-d')) }}">
                        @error('deadline')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-center my-5 d-flex justify-content-center">
                    <button type="submit" form="deleteForm" class="btn btn-danger me-5 d-block" onclick="return confirm('本当に削除しますか？')">削除</button>
                    <button type="submit" class="btn btn-primary d-block">更新</button>
                </div>
            </form>
            {{-- 削除form(formタグの入れ子はNGのため切り分け。実行ボタンはidで指定可能) --}}
            <form action="{{ route('memo.destroy', $memo) }}" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</x-app-layout>
