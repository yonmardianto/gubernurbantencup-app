<div class="wsus__dashboard_sidebar">
    <div class="wsus__dashboard_sidebar_top">
        <div class="dashboard_banner">
            <img src="{{ asset('frontend/assets/images/single_topic_sidebar_banner.jpg') }}" alt="img"
                class="img-fluid">
        </div>
        <div class="img">
            <img src="{{ asset('default-files/avatar.png') }}" alt="profile" class="img-fluid w-100">
        </div>
        <h4>{{ auth()->user()->name }}</h4>
        <p id="club-display">{{ auth()->user()->club }}</p>
        <p>
            Manager Team &nbsp;
            <a href="#" id="btn-edit-club" title="Edit Nama Club" style="font-size:12px;">
                <i class="fa fa-pencil"></i> Edit
            </a>
        </p>
    </div>
    <ul class="wsus__dashboard_sidebar_menu">
        <li>
            <a href="{{ route('manager-team.dashboard') }}"
                class="{{ request()->is('manager-team/dashboard') ? 'active' : '' }}"><i class="fa fa-edit"></i> &nbsp;
                Entry By Name</a>

        </li>

        <li>
            <a href="{{ route('manager-team.participants.index') }}"
                class="{{ request()->routeIs('manager-team.participants.*') ? 'active' : '' }}"><i
                    class="fa fa-list"></i> &nbsp; Peserta </a>
        </li>

        <li>
            <a href="{{ route('manager-team.payments.index') }}"
                class="{{ request()->routeIs('manager-team.payments.*') ? 'active' : '' }}"><i class="fa fa-money"></i>
                &nbsp; Upload Bukti Transfer </a>
        </li>


        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}" alt="icon"
                            class="img-fluid w-100">
                    </div>
                    Sign Out
                </a>
            </form>
        </li>
    </ul>
</div>

<!-- Modal Edit Club -->
<div class="modal fade" id="modalEditClub" tabindex="-1" aria-labelledby="modalEditClubLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditClubLabel">Edit Nama Club</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="form-edit-club" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="input-club" class="form-label">Nama Club <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="input-club" name="club"
                            value="{{ auth()->user()->club }}" required maxlength="255">
                        <div class="invalid-feedback" id="club-error"></div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-club">
                    <span id="btn-save-text" class="text-white">Simpan</span>
                    <span id="btn-save-spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                </button>
            </div>

        </div>
    </div>
</div>