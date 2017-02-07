<form class="stdform stdform2" method="post" action="forms.html">
        <p>
            <label>First Name</label>
            <span class="field">
                <input type="text" name="firstname" id="firstname2" class="form-control" />
            </span>
        </p>
        
        <p>
            <label>Last Name</label>
            <span class="field">
                <input type="text" name="lastname" id="lastname2" class="form-control" />
            </span>
        </p>
        
        <p>
            <label>Email</label>
            <span class="field">
                <input type="text" name="email" id="email2" class="form-control" />
            </span>
        </p>
        
        <p>
            <label>Location <small>You can put your own description for this field here.</small></label>
            <span class="field">
                <textarea cols="80" rows="5" name="location" id="location2" class="form-control"></textarea>
            </span>
        </p>
        
        <p>
            <label>Select</label>
            <span class="field"><select name="selection" id="selection2" class="uniformselect">
                <option value="">Choose One</option>
                <option value="1">Selection One</option>
                <option value="2">Selection Two</option>
                <option value="3">Selection Three</option>
                <option value="4">Selection Four</option>
            </select></span>
        </p>
                                
        <p class="stdformbutton">
            <button class="btn btn-primary">Submit Button</button>
            <button type="reset" class="btn btn-default">Reset Button</button>
        </p>
</form>