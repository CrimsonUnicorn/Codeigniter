import React, { useState, useEffect } from 'react';
import API from '../api/api';

function Teachers() {
  const [teachers, setTeachers] = useState([]);
  const [form, setForm] = useState({ name: '', subject: '' });

  const fetchTeachers = async () => {
    const res = await API.get('/teachers');
    setTeachers(res.data);
  };

  useEffect(() => { fetchTeachers(); }, []);

  const handleChange = e => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async e => {
    e.preventDefault();
    await API.post('/teacher', form);
    setForm({ name: '', subject: '' });
    fetchTeachers();
  };

  return (
    <div>
      <h2>Teachers</h2>
      <form onSubmit={handleSubmit}>
        <input name="name" placeholder="Name" value={form.name} onChange={handleChange} />
        <input name="subject" placeholder="Subject" value={form.subject} onChange={handleChange} />
        <button type="submit">Add Teacher</button>
      </form>
      <ul>
        {teachers.map(t => (
          <li key={t.id}>{t.name} - {t.subject}</li>
        ))}
      </ul>
    </div>
  );
}

export default Teachers;
