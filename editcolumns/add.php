<form>
    <p>Column Name: 
        <input type="text" id="textaddcolumnname" name="columnname"/>
    </p>
    <p class="fineprint">
        this is the name and must not contain spaces
    </p>
    <p>Data Type: 
        <select id="textadddatatype" name="datatype">
            <option>int(11)</option>
            <option>tinyint(1)</option>
            <option>varchar(100)</option>
        </select>
    </p>
    <p class="fineprint">
        int is basically a number<br/>
        tinyint is basically a boolean/binary/checkbox/off-on value<br/>
        varchar is basically text<br/>
    </p>
    <p>Label: 
        <input type="text" id="textaddlabel" name="label"/>
    </p>
    <p class="fineprint">
        this is visible to the use and can contain any character types you want... but don't get crazy.
    </p>
    <p>
        <input type="button" id="buttonadd" name="label" value="Add Now" onclick="addNow();"/>
    </p>
</form>
