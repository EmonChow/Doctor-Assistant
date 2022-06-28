<template>
    <div class="container mt-10 mb-10">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="card">
                    <div class="card-header">Forget Password</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Enter Your Email Address</label>
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
    name: "ForgetPassword"
}
</script>

<style scoped>

</style>
