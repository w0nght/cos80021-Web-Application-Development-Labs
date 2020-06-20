exceptionTest = function() {
    alert('starting');
    try {
        var x;  x[1] = 3;
    }
    catch (err) { 
        alert ('error: ' + err.message);
    }
    finally { 
        alert ('complete');
    }
}

 