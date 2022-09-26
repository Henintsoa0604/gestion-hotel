@if(Auth::guard('web')->check())
 <p class="text-success">
 	Miconecte aminin <strong>USER</strong>
 </p>
@else
 <p class="text-danger">
 	Tsa Miconecte aminin <strong>USER</strong>
 </p>
 @endif

 @if(Auth::guard('admin')->check())
 <p class="text-success">
 	Miconecte aminin <strong>Admin</strong>
 </p>
@else
 <p class="text-danger">
 	Tsa Miconecte aminin <strong>Admin</strong>
 </p>
 @endif