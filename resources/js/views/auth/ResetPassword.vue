<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Enter Your Email Address</label>
                            <input type="email" class="form-control"
                                   placeholder="email@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">PIN number</label>
                            <input type="email" class="form-control"
                                   placeholder="email@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="email" class="form-control"
                                   placeholder="email@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Re-Type Password</label>
                            <input type="email" class="form-control"
                                   placeholder="email@example.com">
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <router-link :to="{name: 'auth.login'}" class="float-end">Login</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ResetPassword"
}
</script>

<style scoped>

</style>
