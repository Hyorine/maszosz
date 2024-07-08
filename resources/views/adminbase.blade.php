<div >
    <div class="admininterface-row">
        <div>
             @include('adminUsers')
        </div>
        <div class="image-section">
            @include('adminRank')
        </div>
    </div>
    <div class="admininterface-row">
         <div class="image-section">
            @include('adminForumThemes')
        </div>
        <div class="image-section">
            
        </div>
    </div>
    <div class="admininterface-row">
        <div class="image-section">
            @include('adminGalery')
        </div>
        <div class="image-section">
            @include('adminGaleryDelet')
        </div>
    </div>
    <div class="admininterface-row">
        <div class="monster-section">@include('adminMonster')</div>
        <div>@include('adminMonsterDelet')</div>
    </div>
    <div class="admininterface-row">
        <div class="image-section">
            @include('adminNews')
        </div>
        <div class="image-section">
        @include('eventDelet')
        </div>
    </div>
</div>