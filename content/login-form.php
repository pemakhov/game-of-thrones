<form id="sign-up" action="">
    <div id="first-page">
        <label>Enter your email</label>
        <span class="validation-message"><? print ($_SESSION['invEmailMessage'] ?? '') ?></span>
        <input type="email" name="email" placeholder="arya@westeros.com" id="email">
        <hr>
        <label>
            Choose secure password
            <span class="description">Must be at least 8 characters</span>
            <span class="validation-message"><? print ($_SESSION['invPassMessage'] ?? '') ?></span>
        </label>
        <input type="password" name="password" placeholder="password" id="password">
        <hr>
        <div class="box">
            <div class="box__element">
                <input type="checkbox" name="remember-me" value="remember-me" id="remember-me">
                <label for="remember-me"><span>Remember me</span></label>
            </div>
        </div>
        <input type="submit" value="Sign up">
    </div>
</form>
