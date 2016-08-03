<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel - React Employee Test</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ReactJS Phonebook</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <br><br>
        <div class="container">

            <div class="starter-template">
                <h1>ReactJS Laravel Phonebook</h1>
                <p class="lead">This is a simple phonebook using ReactJS and Laravel, it was designed to get my feet wet in React and Laravel. </p>
                <div id="content"></div>
            </div>

        </div><!-- /.container -->

        <script type="text/babel">
            var Phonebook = React.createClass({
                getInitialState: function() {
                    return {
                        allphoneentries: []
                    };
                },
                _getPhoneEntries: function() {
                    $.get('/api/phonebook/all',function(data) {
                        this.setState({ allphoneentries: data });
                    }.bind(this));
                },
                componentDidMount: function() {
                    this._getPhoneEntries();
                    setInterval(this._getPhoneEntries, 2000);
                },
                render: function() {
                    var handlePhones = this.state.allphoneentries.map(function(phone) {
                        return <PhonebookBanner key={phone.id} id={phone.id} name={phone.name} phone={phone.phone_number} address1={phone.address1} address2={phone.address2} city={phone.city} state={phone.state} zipcode={phone.zip_code}/>
                    });
                    return (
                        <div>
                            <PhonebookHeader />
                            <PhonebookPoster />
                            {handlePhones}
                        </div>
                    );
                }
            });
            var PhonebookHeader = React.createClass({
                render: function() {
                    return (
                        <h2> Enter the details to be saved! </h2>
                    );
                }
            });
            var PhonebookPoster = React.createClass({
                _handleClick: function() {
                    var phoneValue = this.refs.phonevalue.value;
                    var nameValue  = this.refs.namevalue.value;
                    var address1Value  = this.refs.address1value.value;
                    var address2Value  = this.refs.address2value.value;
                    var cityValue  = this.refs.cityvalue.value;
                    var stateValue  = this.refs.statevalue.value;
                    var zipcodeValue  = this.refs.zipcodevalue.value;

                    // Resetting the form to blank, I'm not sure if there is a better way
                    // to do this in react or not.
                    this.refs.phonevalue.value = "";
                    this.refs.namevalue.value = "";
                    this.refs.address1value.value = "";
                    this.refs.address2value.value = "";
                    this.refs.cityvalue.value = "";
                    this.refs.statevalue.value = "";
                    this.refs.zipcodevalue.value = "";

                    $.post('/api/phonebook/create', {
                        phone: phoneValue,
                        name: nameValue,
                        address1: address1Value,
                        address2: address2Value,
                        city: cityValue,
                        state: stateValue,
                        zipcode: zipcodeValue,
                        _token: '{{ csrf_token() }}'
                    }, function(data) {
                        console.log(data);
                        this._getPhoneEntries();
                    });
                },
                render: function() {
                    return (
                        <div>
                            <input type="text" className="form-control" id="name" placeholder="Name" ref="namevalue" /><br />
                            <input type="text" className="form-control" id="phone" placeholder="Phone Number" ref="phonevalue" /><br />
                            <input type="text" className="form-control" id="address1" placeholder="Address 1" ref="address1value" /><br />
                            <input type="text" className="form-control" id="address2" placeholder="Address 2" ref="address2value" /><br />
                            <input type="text" className="form-control" id="city" placeholder="City" ref="cityvalue" /><br />
                            <input type="text" className="form-control" id="state" placeholder="State" ref="statevalue" /><br />
                            <input type="text" className="form-control" id="zip_code" placeholder="Zip Code" ref="zipcodevalue" /><br />
                            <input type="button" className="btn btn-success" value="Add" onClick={this._handleClick} />
                        </div>
                    );
                }
            });
            var PhonebookBanner = React.createClass({
                getInitialState: function() {
                    return {
                        editinput: false
                    };
                },
                _removeItem: function() {
                    console.log(this.props.id);
                    $.post('/api/phonebook/delete',{
                        id: this.props.id,
                        _token: '{{ csrf_token() }}'
                    }, function(data) {
                        console.log(data);
                    });
                },
                _editItem: function() {
                    this.state.editinput ? this.setState({ editinput: false }) : this.setState({ editinput: true });
                },
                _handleSubmit: function() {
                    var editedNameValue = this.refs.editedNameValue.value;
                    var editedPhoneValue = this.refs.editedPhoneValue.value;
                    var editedAddress1Value = this.refs.editedAddress1Value.value;
                    var editedAddress2Value = this.refs.editedAddress2Value.value;
                    var editedCityValue = this.refs.editedCityValue.value;
                    var editedStateValue = this.refs.editedStateValue.value;
                    var editedZipCodeValue = this.refs.editedZipCodeValue.value;

                    $.post('/api/phonebook/edit', {
                        id: this.props.id,
                        name: editedNameValue,
                        phone: editedPhoneValue,
                        address1: editedAddress1Value,
                        address2: editedAddress2Value,
                        city: editedCityValue,
                        state: editedStateValue,
                        zipcode: editedZipCodeValue,
                        _token: '{{ csrf_token() }}'
                    },function() {
                        this.setState({ editinput: false });
                        this._getPhoneEntries();
                    }.bind(this));
                },
                render: function() {
                    return(
                        <div className="container">
                            <p>&nbsp;</p>
                            <div className="row">
                                <div className="col-md-6">
                                    <b>Name: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.name} ref="editedNameValue" /> : this.props.name}<br />
                                    <b>Phone Number: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.phone} ref="editedPhoneValue" /> : this.props.phone}<br />
                                    <b>Address 1: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.address1} ref="editedAddress1Value" /> : this.props.address1}<br />
                                    <b>Address 2: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.address2} ref="editedAddress2Value" /> : this.props.address2}<br />
                                    <b>City: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.city} ref="editedCityValue" /> : this.props.city}<br />
                                    <b>State: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.state} ref="editedStateValue" /> : this.props.state}<br />
                                    <b>Zip Code: </b>{this.state.editinput ? <input type="text" defaultValue={this.props.zipcode} ref="editedZipCodeValue" /> : this.props.zipcode}
                                </div>
                                <div className="col-md-6">
                                    {this.state.editinput ? <div> <button className="btn btn-success" onClick={this._handleSubmit} > Done </button> <br /><br /> </div> : null}
                                    <button className="btn btn-default" onClick={this._editItem} > Edit </button>&nbsp;&nbsp;&nbsp;
                                    <button className="btn btn-danger" onClick={this._removeItem} > Remove </button>
                                </div>
                            </div>
                        </div>
                    );
                }
            });
            ReactDOM.render(
                <Phonebook />,
                document.getElementById('content')
            );
        </script>
    </body>
</html>