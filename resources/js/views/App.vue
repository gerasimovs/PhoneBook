<template>
    <div id="app">
        <header class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                         <router-link to="/">PhoneBook</router-link>
                    </h1>
                    <h2 class="subtitle">
                        SPA application on VueJs and Buefy
                    </h2>
                </div>
            </div>
        </header>
        <nav class="navbar has-background-white-bis">
            <div class="container">
                <div class="navbar-menu">
                    <div class="navbar-start">
                        <div class="navbar-item field has-addons" v-if="$route.name === 'contacts.index'">
                            <div class="control">
                                <input class="input" type="text" placeholder="Find a contact">
                            </div>
                            <div class="control">
                                <a class="button is-primary">
                                    <b-icon icon="search" size="is-small"></b-icon>
                                    <span>Search</span>
                                </a>
                            </div>
                        </div>
                        <div class="navbar-item" v-else>
                            <router-link class="button is-primary" to="/">
                                <b-icon icon="users" size="is-small"></b-icon>
                                <span>All contacts</span>
                            </router-link>
                        </div>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item">   
                            <router-link class="button is-primary" to="/create">
                                <b-icon icon="plus" size="is-small"></b-icon>
                                <span>Create contact</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="container">
            <router-view></router-view>
        </main>
        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    <strong>PhoneBook</strong> by <a href="https://moikrug.ru/mrteo" target="_blank">Sergey Gerasimov</a>. 
                    The source code is licensed <a href="http://opensource.org/licenses/mit-license.php" target="_blank">MIT</a>.
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {}
</script>
