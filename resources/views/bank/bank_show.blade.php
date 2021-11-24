
    <div class="form-group">
        <label class="form-label text-dark">Account Holder Name</label>
        <input type="text" value="{{ $account->account_holder_name }}" name="holder_name" class="form-control" id="holder_name" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Address</label>
        <input type="text" name="address" value="{{ $account->address}}" class="form-control" id="address" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Account Holder Type </label>
        <select id="" class="form-control" name="holder_type" disabled>
            <option value="">Select</option>
            <option value="personal" @if($account->account_holder_type == "personal") selected @endif>Personal</option>
            <option value="company" @if($account->account_holder_type == "company") selected @endif>Company</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Account Type </label>
        <select id="" class="form-control" name="account_type" disabled>
            <option value="">Select</option>
            <option value="saving"  @if($account->bank_account_type == "saving") selected @endif>Saving</option>
            <option value="checking"  @if($account->bank_account_type == "checking") selected @endif>Checking </option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Account Currency</label>
        <input type="text" value="{{$account->bank_account_currency}}" class="form-control" name="currency" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">IBAN</label>
        <input type="text" value="{{$account->IBAN}}" class="form-control" name="iban" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Swift number</label>
        <input type="text" value="{{$account->bank_swift_number}}" class="form-control" name="swift" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Territory</label>
        <input type="text" value="{{$account->bank_territory}}" class="form-control" name="territory" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Code</label>
        <input type="text" value="{{$account->bank_code}}" class="form-control" name="code" disabled>

    </div>
    <div class="form-group">
        <label class="form-label text-dark">Bank Account Number</label>
        <input type="text" value="{{$account->bank_account_number}}" class="form-control" name="number" disabled>
    </div>

    </div>


