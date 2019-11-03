<form id="save" action="">
    <div id="second-page">
        <blockquote>
            <p>You've successfully joined the game.<br>
                Tell us more about yourself.</p>
        </blockquote>
        <label>
            Who are you?
            <span class="description">Alpha-numeric username</span>
            <span class="validation-message"><? print ($_SESSION['invNameMessage'] ?? '') ?></span>
        </label>
        <input id="name" type="text" name="name" placeholder="arya">
        <hr>
        <label>
            Your Great House
            <span class="validation-message"><? print ($_SESSION['invHouseMessage'] ?? '') ?></span>
        </label>
        <select id="house" name="house" class="select-house">
            <option selected="selected" value="0">Select House</option>
            <option value="arryn">Arryn of the Eyrie</option>
            <option value="baratheon">Baratheon of Storm's End</option>
            <option value="greyjoy">Greyjoy of Pyke</option>
            <option value="martell">Martell of Sunspear</option>
            <option value="lannister">Lannister of Casterly Rock</option>
            <option value="stark">Stark of Winterfell</option>
            <option value="targaryen">Targaryen of King's Landing</option>
            <option value="tully">Tully of Riverrun</option>
            <option value="tyrell">Tyrell of Highgarden</option>
        </select>
        <hr>
        <label>
            Your preferences, hobbies, wishes, etc.
            <span class="description">3 to 250 words</span>
            <span class="validation-message"><? print ($_SESSION['invHobbiesMessage'] ?? '') ?></span>
        </label>
        <textarea id="hobbies" name="hobbies" cols="30" rows="2"
                  placeholder="I have a long TOKILL list..."></textarea>
        <hr>
        <input type="submit" value="Save">
    </div>
</form>
