<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="/" class="navbar-brand">Organizer</a>
        </div>
        @if(Auth::user())
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Calendars <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="/">Dashboard</a></li>
                            <li><a href="">Management</a></li>
                        </ul>
                    </li>
                    <li>
                        <a aria-expanded="false" role="button" href="#"> Events </a>
                    </li>
                    <li>
                        <a aria-expanded="false" role="button" href="#"> To-Do List </a>
                    </li>
                    @php
                        $incomingContactRequestsCount = count(Auth::user()->getIncomingContactRequests());
                    @endphp
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Contacts @if($incomingContactRequestsCount)<span class="label label-primary">{{ $incomingContactRequestsCount }}</span> @endif<span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{ route('contacts.list') }}">List</a></li>
                            <li><a href="{{ route('contacts.management') }}">Management</a></li>
                        </ul>
                    </li>
                    <li>
                        <a aria-expanded="false" role="button" href="{{ route('settings.index') }}"> Settings </a>
                    </li>
                    @role('admin')
                    <li>
                        <a aria-expanded="false" role="button" href="{{ route('admin.users') }}"> Admin Panel </a>
                    </li>
                    @endrole
                </ul>
                @if(Auth::user())
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="/logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        @endif
    </nav>
</div>


