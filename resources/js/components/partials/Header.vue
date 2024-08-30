<template>
    <div class="d-flex align-items-center justify-content-between p-3">
        <div>
           <a href="/"
           >
           <img
                src="../../../../public/assets/avatar.png"
                alt="profile-image"
                width="50px"
            />
        </a>
        </div>
        <div><b>Phone Book</b></div>
        <div>
            <a href="/contacts/create" class="btn btn-primary addBtn">
                <i class="bi bi-plus"></i>
            </a>
        </div>
    </div>
</template>

<script>
export  default {
    name: "Header"
}
</script>
